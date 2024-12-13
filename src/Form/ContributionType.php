<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Projet;
use App\Entity\Contribution;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContributionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('montant')
            ->add('date', null, [
                'widget' => 'single_text',
            ])
            ->add('utilisateur', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])
            ->add('projet', EntityType::class, [
                'class' => Projet::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contribution::class,
        ]);
    }

   
}
