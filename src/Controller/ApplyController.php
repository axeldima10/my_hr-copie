<?php

namespace App\Controller;

use App\Entity\Apply;
use App\Entity\State;
use App\Form\ApplyType;
use App\Entity\Document;
use App\Form\FilterType;
use App\Entity\JobSeeker;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use App\Repository\ApplyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/apply')]
class ApplyController extends AbstractController
{
    #[Route('/all', name: 'app_apply_index', methods: ['GET'])]
    public function index(ApplyRepository $applyRepository, Request $request): Response
    {
        $form= $this->createForm(FilterType::class);
        $form->handleRequest($request);
        // Par défaut, toutes les candidatures
        $applies = $applyRepository->findAll();

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $filters = [
                'reference' => $data->getReference(),
                'experience' => $data->getExperience(),
                //'skills' => $data->getSkills(),
                'diplome' => $data->getDiplome(),
            ];
            $applies = $applyRepository->findByFilters($filters);
            

        }

        return $this->render('apply/index.html.twig', [
            'applies' => $applies,
            'form'=>$form
        ]);
    }

    #[Route('/new', name: 'app_apply_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager,SluggerInterface $slugger): Response
    {
        $apply = new Apply();
        $form = $this->createForm(ApplyType::class, $apply);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /*  // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            $brochureFile = $form->get('fichiers')->getData();
            if ($brochureFile) {
                $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $brochureFile->move($brochuresDirectory, $newFilename);
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $doc= new Document();
                $doc->setFilename($newFilename);
                $apply->addDocument($doc);
                 // ... persist the $product variable or any other work
                $entityManager->persist($doc);
                 
            } */
            
            $fichiers=$form->get("fichiers")->getData();
            foreach ($fichiers as $fichier) {
                $filename = md5(uniqid()) . '.' . $fichier->guessExtension();
                $fichier->move($this->getParameter('file_directory'), $filename);
                $doc= new Document();
                $doc->setFilename($filename);
                $apply->addDocument($doc);
                $entityManager->persist($doc);
            }  
            $name=$form->get("lastName")->getData();
            $prenom=$form->get("firstName")->getData();
            $email=$form->get("email")->getData();
            $tel=$form->get("tel")->getData();

        
            $candidat = new JobSeeker;
            $candidat->setLastName($name)
                    ->setFirstName($prenom)
                    ->setEmail($email)
                    ->setTel($tel);
            
            $etat = new State;
            $apply->setJobSeeker($candidat) 
                ->setState($etat); 

            
            //dd($fichiers);
            $entityManager->persist($apply);
            $entityManager->flush();

            $this->addFlash('success',"Votre candidature a bien été soumise, 
            nous vous répondrons dans les meilleurs délais");
            

            return $this->redirectToRoute('app_apply_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('apply/candidature.html.twig', [
            'apply' => $apply,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_apply_show', methods: ['GET'])]
    public function show(Apply $apply): Response
    {
        return $this->render('apply/show.html.twig', [
            'apply' => $apply,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_apply_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Apply $apply, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ApplyType::class, $apply);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_apply_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('apply/edit.html.twig', [
            'apply' => $apply,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_apply_delete', methods: ['POST'])]
    public function delete(Request $request, Apply $apply, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$apply->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($apply);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_apply_index', [], Response::HTTP_SEE_OTHER);
    }
}
