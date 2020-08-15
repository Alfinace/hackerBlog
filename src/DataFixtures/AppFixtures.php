<?php
/*
 * @Author: your name
 * @Date: 2020-08-06 14:13:44
 * @LastEditTime: 2020-08-15 14:14:41
 * @LastEditors: Please set LastEditors
 * @Description: In User Settings Edit
 * @FilePath: /cours-symfony-container/src/DataFixtures/AppFixtures.php
 */
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
        for ($i=0; $i < 4 ; $i++) { 
            $pin = new Pin;
            $pin->setTitle($faker->name);
            $pin->setDescription($faker->paragraph($nbSentences = 8 , $variableNbSentences = true));
            $manager->persist($pin);
        }

        $manager->flush();
    }
}