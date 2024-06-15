<?php

namespace App\Form;

use App\Entity\Apply;
use App\Entity\Diplome;
use App\Entity\Experience;
use App\Entity\Skills;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class FilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('reference', TextType::class, [
                'label'=>false, 
                'required' => false, 
                'attr' =>[
                    'placeholder' => 'Rechercher'
                ]
            ])
            ->add('experience', EntityType::class, [
                'label'=>false,
                'required' =>false, 
                'class'=> Experience::class,
                'expanded'=>true,
                'choice_label' => 'year', 
                
            ] )
            /* ->add('skills', EntityType::class, [
                'label'=>false,
                'required'=>false, 
                'class'=>Skills::class, 
                'expanded'=>true,
                'choice_label' => 'label',
                'multiple'=>true
            ]) */
            ->add('diplome', EntityType::class, [
                'label'=>false,
                'required'=>false, 
                'class'=>Diplome::class,
                'expanded'=>true,
                'choice_label' => 'title',
                'multiple'=>false
            ])
            /* ->add('status')
            ->add('state') 
            ->add('jobSeeker') */
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Apply::class,
            'method' => 'GET',
            'csrf_protection' => false
        ]);

        
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
