<?php

namespace App\Form;

use App\Entity\Interro;
use App\Entity\Matiere;
use App\Entity\Eleve;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
            ->add('matiere', EntityType::class, [
                'class' => Matiere::class,
                'label' => 'Matière',
                'required' => true,
                'placeholder' => 'Sélectionner une matière',
                'mapped' => false,
            ])
            ->add('libelleInterro', TextType::class, [
                'label' => 'Libellé de l\'interro',
            ])
            ->add('eleve', EntityType::class, [
                'class' => Eleve::class,
                'label' => 'Elève',
                'required' => true,
                'placeholder' => 'Sélectionner un élève',
                'mapped' => false,
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
