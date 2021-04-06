<?php

namespace App\Form;

use App\Entity\Generaliste;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GeneralisteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Symptome')
            ->add('Antecedents')
            ->add('Traitements')
            ->add('temperature')
            ->add('pressionArterielle')
            ->add('gorge')
            ->add('tympans')
            ->add('palpation')
            ->add('auscultation')
            ->add('percussion')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Generaliste::class,
        ]);
    }
}
