<?php

namespace App\Form;

use App\Entity\Adresse;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class AdresseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('number', NumberType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuiller entrer une valeur',
                    ]),
                ]
            ])
            ->add('streetName', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuiller entrer une valeur',
                    ]),
                ]
            ])
            ->add('zipCode', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuiller entrer une valeur',
                    ]),
                ]
            ])
            ->add('city', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuiller entrer une valeur',
                    ]),
                ]
            ])
            ->add('country', CountryType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Adresse::class,
        ]);
    }
}
