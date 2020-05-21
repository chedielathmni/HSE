<?php

namespace App\Form;

use App\Entity\PremiersSecours;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PremiersSecoursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('inhalation', TextareaType::class, [
                'label' => "En cas d'inhatation:"
            ])
            ->add('yeux', TextareaType::class, [
                'label' => "En cas de contact avec les yeux:"
            ])
            ->add('peau', TextareaType::class, [
                'label' => "En cas de contact avec la peau:"
            ])
            ->add('ingestion', TextareaType::class, [
                'label' => "En cas d'ingestion:"
            ])
            ->add('symptomes', TextareaType::class, [
                'label' => "Principaux symptômes et effets, aigus et différés:"
            ])
            ->add('soins', TextareaType::class, [
                'label' => "Indication des éventuels soins médicaux immédiats et traitements particuliers nécessaires:"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PremiersSecours::class,
        ]);
    }
}
