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
        // On construit un template pour créer un produit
        $builder
            // Une petite zone de texte pour le nom du produit avec un placeholder (Nom du produit)
            ->add('nom', TextType::class, [
                "attr" =>[
                    "placeholder" => "Nom du produit",
                ],
            ])
            // Une petite zone de texte pour la catégorie du produit avec un placeholder (Catégorie du produit)
            ->add("categorie", TextType::class, [
                "attr" => [
                    "placeholder" => "Catégorie du produit",
                ]
            ])
            // Une grande zone de texte pour la description du produit avec un placeholder (Description du produit)
            ->add('description', TextareaType::class, [
                "attr" =>[
                    "placeholder" => "Description du produit",
                    "cols" => 10,
                    "rows" => 10,
                ],
            ])
            // Système d'upload de fichier, acceptant les formats png/jpeg, pour upload une image
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
            // Bouton pour terminer et envoyer le formulaire
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
