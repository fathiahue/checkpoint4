<?php

namespace App\Form;

use App\Entity\Annonce;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;

class AnnoncesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
     
        $builder
            ->add('title',TextType::class,[

            ])

            ->add('telephone',IntegerType::class,[
                'required' => false,

            ])
            ->add('mail',EmailType::class,[

            ])
            ->add('image', FileType::class, [
                'label' => 'Fichier média',

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/bmp',
                            'image/gif',
                            'image/jpeg',
                            'image/png',
                            'image/svg+xml',
                            'image/webp',
                            'video/x-msvideo',
                            'video/mpeg',
                            'video/ogg',
                            'video/webm',
                            'video/3gpp',
                            'video/3gpp2'
                        ],
                        'mimeTypesMessage' => 'Merci de téléverser une photo ou une vidéo valide.',
                    ])
                ],
            ])
        
    
            ->add('description',TextareaType::class,[
                'attr' => ['rows' => 6],

                ])

            ->add('Valider',SubmitType::class,[
                    ])
            
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Annonce::class,
        ]);
    }
}
