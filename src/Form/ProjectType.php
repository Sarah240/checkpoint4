<?php

namespace App\Form;

use App\Entity\Project;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                "label" => "Nom du projet :",
                "attr" => [
                    "placeholder" => "Entrez le nom du projet..."
                ]
            ])

            ->add('image', TextType::class, [
                "label" => "Image :",
                "required" => false,
                "attr" => [
                    "placeholder" => "Insérez une image..."
                ]
            ])
            
            ->add('text', TextType::class, [
                "label" => "Description du projet",
                "attr" => [
                    "placeholder" => "Entrez la description du projet..."
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
