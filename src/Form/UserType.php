<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Booking;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,[
                'label' => 'Nom',
            ])

            ->add('surname', TextType::class,[
                'label' => 'Prénom',
            ])

            ->add('email', TextType::class,[
                'label' => 'Email',
            ])

            ->add('phone', TextType::class,[
                'label' => 'Téléphone',
            ])

            ->add('streetNumber', TextType::class,[
                'label' => 'Numéro',
            ])

            ->add('street', TextType::class,[
                'label' => 'Rue',
            ])
            
            ->add('postalCode', TextType::class,[
                'label' => 'Code postal',
            ])

            ->add('city', TextType::class,[
                'label' => 'Ville',
            ])
            
            ->add('isAdmin', CheckboxType::class,[
                'label' => 'Administrateur',
                'required' => false,
            ])       
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
