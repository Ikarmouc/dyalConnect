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
        $builder
            ->add('nomEvt', TextType::class, [
                "attr" =>[
                    "placeholder" => "Nom d'événement",
                ],
            ])
            ->add('detailEvt', TextareaType::class, [
                "attr" =>[
                    "placeholder" => "Detail d'événement",
                    "cols" => 10,
                    "rows" => 10,
                ],
            ])
            ->add('dateEvt', TextType::class, [
                "attr" =>[
                    "placeholder" => "Date d'événement",
                ],
            ])
            ->add('horaireEvt', TextType::class, [
                "attr" =>[
                    "placeholder" => "Horaire d'événement",
                ],
            ])
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
