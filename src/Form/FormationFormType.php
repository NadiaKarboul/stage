<?php

namespace App\Form;

use App\Entity\Formation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\Callback ;



class FormationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom_formation')
            ->add('description')
            ->add('image', FileType::class, [
                'label' => 'choisir un fichier',
                'mapped' => true,
                'required' => false,
                'data_class' => null,
                'attr' => [
                    'accept' => '.jpg, .jpeg, .png',
                ],    'constraints' => [
                    new File([
                        'maxSize' => '2M',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid JPG, JPEG or PNG image',
                    ])
                ],
            
            ])
          
            ->add('date_debut', DateTimeType::class, [
                'required' => false, // Set this to false to allow "null" values
                'widget' => 'single_text',
                'attr' => ['class' => 'form-control', 'placeholder' => 'debut Name', 'id' => 'datepickerdedone'],
                
            ])

            ->add('date_fin', DateTimeType::class, [
                'required' => false, // Set this to false to allow "null" values
                'widget' => 'single_text',
                'attr' => ['class' => 'form-control', 'placeholder' => 'debut Name', 'id' => 'datepickerdedone'],
            ])
            ->add('save',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Formation::class,
            'allow_extra_fields' => true, // Allow extra fields for the image file upload

        ]);
    }


 
}
