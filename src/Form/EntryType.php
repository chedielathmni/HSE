<?php

namespace App\Form;

use App\Entity\Entry;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Positive;

class EntryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quantityUsed', IntegerType::class, [
                'label' => 'Quantité',
                "empty_data" => 0,
                'mapped' => false
            ])
            ->add('wasteQuantity', IntegerType::class, [
                'label' => 'Quantité de déchets',
                "empty_data" => 0,
                'mapped' => false
            ])
            ->add('volume')
            ->add('zone')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Entry::class,
        ]);
    }
}
