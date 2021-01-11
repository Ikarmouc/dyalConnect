<?php

namespace App\Form;

use App\Entity\Image;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
class ImageFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add("image", FileType::class, [
            "label" => "Image (PNG File)",
            "mapped" => false,
            "required" => false,
            "constraints" => [
                new File([
                    "maxSize" => "25000k",
                    "mimeTypes" => [
                        "image/png",
                    ],
                    "mimeTypesMessage" => "PNG uniquement",
                ])
            ]
        ]);

        $builder->add("save", SubmitType::class, [
            "label" => "Enregistrer",
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Image::class,
        ]);
    }
}
