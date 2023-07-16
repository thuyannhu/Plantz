<?php

namespace App\Form;

use App\Entity\Booking;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Greenhouse;
use App\Entity\User;

class BookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('arrivalDate',  DateType::class,[
                'label' => 'Date d\'arrivée',
                'format' => 'ddMMyyyy',
                'placeholder' => [
                    'year' => 'Année', 'month' => 'Mois', 'day' => 'Jour',
                ],
            ])
            ->add('departureDate',  DateType::class,[
                'label' => 'Date de départ',
                'format' => 'ddMMyyyy',
                'placeholder' => [
                    'year' => 'Année', 'month' => 'Mois', 'day' => 'Jour',
                ],

            ])

            ->add('greenhouseId', EntityType::class,[
                'class' => Greenhouse::class,
                'label' => 'Lieu',
                'required' => false,
                'choice_label' => 'name',
                'expanded' => true,
                'multiple' => true,
                'mapped' => false,
                'data' => $builder->getData()->getGreenhouses(),
                
            ])
            ->add('user', EntityType::class, [
                'class' => User::class,
                'label' => 'Client',
                'required' => false,
                'data'=> $builder->getData()->getUser(),
                'choice_label' => function(User $user) {
                    return $user->getName() . ' ' . $user->getSurname();
                },
                // ...
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Booking::class,
        ]);
    }
}
