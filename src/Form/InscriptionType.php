<?php

namespace App\Form;

use App\Entity\Inscription;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('contact')
            ->add('profession')
            ->add('orienter', ChoiceType::class, [
                'choices' => [
                    'Généraliste' => 'generaliste',
                    'Dentiste' => 'dentiste',
                    'Oculiste' => 'oculiste',
                    'Chirurgien' => 'chirurgien',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Inscription::class,
        ]);
    }
}
