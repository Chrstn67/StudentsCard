<?php

namespace App\Form;

use App\Entity\Interro;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InterroType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelleInterro', TextType::class, [
                'label' => 'Libellé de l\'interro',
            ])
            ->add('note', NumberType::class, [
                'label' => 'Note',
            ])
            ->add('coefficient', NumberType::class, [
                'label' => 'Coefficient',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Interro::class,
        ]);
    }
}
