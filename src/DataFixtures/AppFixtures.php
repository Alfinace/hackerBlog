<?php
namespace App\DataFixtures;

use App\Entity\Pin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create("fr_FR");
        for ($i=0; $i < 50; $i++) { 
            $pin = new Pin;
            $pin->setTitle($faker->name);
            $pin->setDescription($faker->paragraph($nbSentences = 20, $variableNbSentences = true));
            $manager->persist($pin);
        }

        $manager->flush();
    }
}