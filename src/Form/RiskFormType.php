<?php

namespace App\Form;

use App\Entity\Projet;
use App\Entity\Risk;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RiskFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Name', TextType::class)
            ->add('IdentificationDate', DateTimeType::class, [
                'date_widget' => 'single_text'
            ])
            ->add('ResolutionDate', DateTimeType::class, [
                'date_widget' => 'single_text'
            ])
            ->add('Probability', NumberType::class)
            ->add('projet', EntityType::class, [
                'class' => Projet::class,
                'choice_label' => 'title',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Risk::class,
        ]);
    }
}
