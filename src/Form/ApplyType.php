<?php

namespace App\Form;

use App\Entity\Apply;
use App\Entity\State;
use App\Entity\Skills;
use App\Entity\Status;
use App\Entity\Diplome;
use App\Entity\JobSeeker;
use App\Entity\Experience;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Count;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\DependencyInjection\Loader\Configurator\security;

class ApplyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('reference',TextType::class, [
                'label'=>'Reference du poste',
                'help'=>'ex : Informaticien, Sécrétaire, Comptable',
                'attr'=>[
                    'placeholder'=>'ex : Informaticien, Sécrétaire, Comptable'
                ]])

                ->add('lastName', TextType::class, [
                    'label'=>'Nom(s)',
                    'mapped'=>false
                ])
                ->add('firstName',TextType::class, [
                    'label'=>'Prenom(s)',
                    'mapped'=>false
                ])
                ->add('email',EmailType::class, [
                    'label'=>"Adresse mail",
                    'mapped'=>false
                ])
                ->add('tel',TelType::class,[
                    'label'=>'Telephone',
                    'mapped'=>false,
                    'help'=>'ex : +221 707145152'
                ])
                ->add('submittingDate',HiddenType::class,[
                    'mapped'=>false
                ])

            ->add('diplome', EntityType::class, [
                'class' => Diplome::class,
                'choice_label' => 'title',
            ])
            ->add('experience', EntityType::class, [
                'class' => Experience::class,
                'choice_label' => 'year',
            ])
            ->add('state', HiddenType::class
            )
            ->add('status', EntityType::class, [
                'class' => Status::class,
                'choice_label' => 'label',
            ])
            ->add('submittingDate',HiddenType::class,[
                'mapped'=>false
            ])
           /*  ->add('jobSeeker', EntityType::class, [
                'class' => JobSeeker::class,
                'choice_label' => 'id',
            ]) */
            ->add('skills', EntityType::class, [
                'class' => Skills::class,
                'choice_label' => 'label',
                'expanded' => true,
                'multiple' => true,
            ])

            ->add('fichiers', FileType::class, [
                'help' => 'joindre un ou plusieurs fichiers?',
                'required' => false,
                'label'=> 'Joindre votre CV',
                //'multiple' => true,
                'mapped' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'file/pdf',
                            'file/x-pdf'
                        ],
                        'mimeTypesMessage' => 'choisir fichier en pdf'
                    ])
                    //new Count(['max' => 3, "maxMessage" => "maximimum 3 images"]),
                    //new All([])
                ],
                /* 'attr' => [
                    'accept' => '.pdf'
                ], */
            ]) 
            ->add('soumettre', SubmitType::class, [
                'attr' => [
                    'class' => "btn btn-primary",
                ]
            ]);

      
            
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Apply::class,
        ]);
    }
}
