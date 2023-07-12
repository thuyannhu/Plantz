<?php

namespace App\DataFixtures;

use Faker\Factory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Greenhouse;

class GreenhouseFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 5; $i++) {
            $greenhouse = new Greenhouse();
            $greenhouse->setLight($faker->numberBetween(450, 800));
            $greenhouse->setHumidity($faker->numberBetween(30, 75));
            $greenhouse->setName('serre '.$faker->word());
            $this->addReference('greenhouse_' . $i, $greenhouse);
            $manager->persist($greenhouse);
        }
        $greenhouse = new Greenhouse();
            $greenhouse->setLight(0);
            $greenhouse->setHumidity(0);
            $greenhouse->setName('a domicile');
            $this->addReference('greenhouse_' . $i, $greenhouse);
            $manager->persist($greenhouse);
        $manager->flush();
    }
}
