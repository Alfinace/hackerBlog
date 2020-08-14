<?php
/*
 * @Author: your name
 * @Date: 2020-08-14 22:38:17
 * @LastEditTime: 2020-08-14 22:54:54
 * @LastEditors: Please set LastEditors
 * @Description: In User Settings Edit
 * @FilePath: /cours-symfony-container/src/DataFixtures/UserFixtures.php
 */

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
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
        $user = new User;
        $user->setEmail('hackerfine@gmail.com')
            ->setPassword($this->passwordEncoder->encodePassword($user,'hackerfine'))
            ->setProfileImage('default.png')
            ->setRoles(['ROLE_USER']);
        $this->em->persist($user);
        $this->em->flush();
    }
}
