<?php

namespace App\Form;

use App\Entity\Evenement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class AjouterEvenement extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // On construit un template pour créer un évènements
        $builder
            // Une petite zone de texte pour le nom de l'évènement avec un placeholder (Nom d'événement)
            ->add('nomEvt', TextType::class, [
                "attr" =>[
                    "placeholder" => "Nom d'événement",
                ],
            ])
            // Une grande zone de texte pour le détail de l'évènement avec un placeholder (Détail d'événement)
            ->add('detailEvt', TextareaType::class, [
                "attr" =>[
                    "placeholder" => "Detail d'événement",
                    "cols" => 10,
                    "rows" => 10,
                ],
            ])
            // Une petite zone de texte pour la date de l'évènement avec un placeholder (Date d'événement)
            ->add('dateEvt', TextType::class, [
                "attr" =>[
                    "placeholder" => "Date d'événement",
                ],
            ])
            // Une petite zone de texte pour les horaires de l'évènement avec un placeholder (Horaires d'événement)
            ->add('horaireEvt', TextType::class, [
                "attr" =>[
                    "placeholder" => "Horaire d'événement",
                ],
            ])
            // Système d'upload de fichier, acceptant les formats png/jpeg, pour upload une image
            ->add("imageEvt", FileType::class, [
                "label" => "Image ou poster concernant événement",
                "mapped" => false,
                "required" => false,
                "constraints" => [
                    new File([
                        "maxSize" => "25000k",
                        "mimeTypes" => [
                            "image/png",
                            "image/jpeg",
                        ],
                        "mimeTypesMessage" => "PNG / JPG",
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
            'data_class' => Evenement::class,
        ]);
    }
}
