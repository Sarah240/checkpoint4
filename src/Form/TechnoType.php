<?php

namespace App\Form;

use App\Entity\Techno;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TechnoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                "label" => "Nom de la technologie :",
                "attr" => [
                    "placeholder" => "Entrez le nom de la technologie..."
                ]
            ])

            ->add('image', TextType::class, [
                "label" => "Image :",
                "required" => false,
                "attr" => [
                    "placeholder" => "Insérez une image..."
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Techno::class,
        ]);
    }
}
