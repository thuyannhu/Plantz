<?php

namespace App\DataFixtures;

use Faker\Factory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Booking;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class BookingFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 5; $i++) {
            $booking = new Booking();
            $booking->setArrivalDate($faker->dateTimeBetween('-1 week', '+1 week'));
            $booking->setDepartureDate($faker->dateTimeBetween('+3 week', '+10 week'));
            $booking->setIsOnsite($faker->boolean());
            $booking->setUser($this->getReference('user_' . $i));
            $manager->persist($booking);
        }
        $manager->flush();
    }
    //Making sure User fixtures load before Booking fixtures
    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}
