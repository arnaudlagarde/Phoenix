<?php

namespace App\Form;

use App\Entity\Portfolio;
use App\Entity\Projet;
use App\Entity\Status;
use App\Entity\Team;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
//            ->add('Title')
//            ->add('description')
//            ->add('startDate')
//            ->add('endedAt')
//            ->add('code')
//            ->add('Done')
//            ->add('status')
//            ->add('portfolio')
//            ->add('Budget')
//            ->add('team')

            ->add('Title', TextType::class)
            ->add('description', TextType::class)
            ->add('startDate', DateTimeType::class, [
                'date_widget' => 'single_text'
            ])
            ->add('code', TextType::class)
            ->add('status', EntityType::class, [
                'class' => Status::class,
                'choice_label' => 'name',
            ])
            ->add('portfolio', EntityType::class, [
                'class' => Portfolio::class,
                'choice_label' => 'name',
            ])
            ->add('budget', BudgetFormType::class)
            ->add('team', EntityType::class, [
                'class' => Team::class,
                'choice_label' => 'name',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Projet::class,
        ]);
    }
}
