<?php

namespace App\Form;

use App\Entity\Maladie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class MaladieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('maladie')
            ->add('categorie', ChoiceType::class, [
                'choices' => [
                    'Correction d’un état de santé altéré par tout moyen disponible' => 'correction d’un état de santé altéré par tout moyen disponible',
                    'Correction de toute détérioration possiblement réversible' => 'correction de toute détérioration possiblement réversible',
                    'Correction des pathologies réversibles et contrôle des symptômes ' => 'correction des pathologies réversibles et contrôle des symptômes ',
                    'Soins palliatifs' => 'soins palliatifs',
                ],
                'label' => 'Niveau d\'intervention'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Maladie::class,
        ]);
    }
}
