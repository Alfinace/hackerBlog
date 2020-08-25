<?php
/*
 * @Author: your name
 * @Date: 2020-08-06 14:13:44
 * @LastEditTime: 2020-08-19 12:05:11
 * @LastEditors: Please set LastEditors
 * @Description: In User Settings Edit
 * @FilePath: /cours-symfony-container/src/DataFixtures/AppFixtures.php
 */
namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Pin;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;
    private $em;
    public function __construct(UserPasswordEncoderInterface $passwordEncoder,EntityManagerInterface $em)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->em = $em;
        
    }
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create("fr_FR");
        for ($i=0; $i < 10; $i++) { 
            $user = new User;
            $email = $faker->freeEmail;
            $user->setEmail($email)
                ->setPassword($this->passwordEncoder->encodePassword($user,$email))
                ->setProfileImage('default.png')
                ->setRoles(['ROLE_USER']);
            $this->em->persist($user);
            $this->em->flush();

            for ($j=0; $j < 30 ; $j++) { 
                $pin = new Pin;
                $pin->setTitle($faker->name)
                    ->setUser($user)
                    ->setDescription($faker->paragraph($nbSentences = 8 , $variableNbSentences = true))
                    ->setCreatedAt($faker->dateTimeThisCentury($max = 'now', $timezone = null))
                    ->setUpdatedAt($faker->dateTimeThisCentury($max = 'now', $timezone = null));
                $this->em->persist($pin);
                $this->em->flush();
            }
        }
    }
}