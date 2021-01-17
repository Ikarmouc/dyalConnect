<?php

namespace App\Form;

use App\Entity\Produit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                "attr" =>[
                    "placeholder" => "Nom du produit",
                ],
            ])
            ->add("categorie", TextType::class, [
                "attr" => [
                    "placeholder" => "Catégorie du produit",
                ]
            ])
            ->add('description', TextareaType::class, [
                "attr" =>[
                    "placeholder" => "Description du produit",
                    "cols" => 10,
                    "rows" => 10,
                ],
            ])
            ->add("image", FileType::class, [
                "label" => "Image du produit (PNG)",
                "mapped" => false,
                "required" => false,
                "constraints" => [
                    new File([
                        "maxSize" => "25000k",
                        "mimeTypes" => [
                            "image/png",
                            "image/jpeg",
                        ],
                        "mimeTypesMessage" => "PNG/JPEG uniquement",
                    ])
                ]
            ])
            ->add("save", SubmitType::class, [
            "label" => "Enregistrer",
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
