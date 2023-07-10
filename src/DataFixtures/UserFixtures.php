<?php

namespace App\DataFixtures;

use Faker\Factory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Faker\Provider\Address;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 25; $i++) {
            $user = new User();
            $user->setName($faker->firstName());
            $user->setSurname($faker->lastName());
            $user->setEmail($faker->email());
            $user->setPhone($faker->phoneNumber());
            $user->setStreet($faker->streetName());
            $user->setStreetNumber($faker->randomNumber(2, true));
            $user->setCity($faker->city());
            $user->setPostalCode(Address::postcode());
            $user->setPassword($faker->password());
            $user->setIsAdmin($faker->boolean(false));
            $this->addReference('user_' . $i, $user);
            $manager->persist($user);
        }
        $manager->flush();
    }
}
