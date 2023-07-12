<?php

namespace App\Form;

use App\Entity\Greenhouse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class GreenhouseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('light', TextType::class, [
                'label' => 'Lumière',
            ])
            ->add('humidity', TextType::class, [
                'label' => 'Humidité',
            ])
            ->add('name', TextType::class, [
                'label' => 'Nom',
            ]);
                         

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Greenhouse::class,
        ]);
    }
}