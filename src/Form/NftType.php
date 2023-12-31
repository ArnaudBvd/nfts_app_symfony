<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Nft;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class NftType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class)

            ->add('category', EntityType::class, [
                "class" => Category::class,
                "label" => "Catégorie"
                ])

            ->add('image', FileType::class, [
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '5000k',
                        'mimeTypes' => [
                            'image/png',
                            'image/jpeg',
                            'image/webp',
                        ],
                        'mimeTypesMessage' => "Veuillez uploader une image au bon format"
                    ])
                ]
            ])
            ->add('valeur', NumberType::class)
            ->add('quantity', NumberType::class, [
                "label" => "Quantité"
            ])
            ->add('Valider', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Nft::class,
            'csrf_protection'=> true 
        ]);
    }
}
