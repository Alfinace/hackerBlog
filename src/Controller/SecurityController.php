<?php
/*
 * @Author: your name
 * @Date: 2020-08-14 22:29:46
 * @LastEditTime: 2020-08-15 14:26:27
 * @LastEditors: Please set LastEditors
 * @Description: In User Settings Edit
 * @FilePath: /cours-symfony-container/src/Controller/SecurityController.php
 */

namespace App\Controller;


use App\Entity\User;
use App\Form\RegistreType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    private $passwordEncoder;
    private $em;
    public function __construct(UserPasswordEncoderInterface $passwordEncoder,EntityManagerInterface $em)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->em = $em;
        
    }
    
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
           $this->redirectToRoute('app_index_pin');
         }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \Exception('This method can be blank - it will be intercepted by the logout key on your firewall');
    }
    /**
     * @Route("/registration",name="app_security_registration")
     */

    public function registre(Request $request):Response
    {
        $user = new User;
       $form = $this->createForm(RegistreType::class,$user);
       $form->handleRequest($request);
       
       if ($form->isSubmitted() && $form->isValid()) { 
           $user->setPassword($this->passwordEncoder->encodePassword($user,$user->getPassword()));
        $user->setProfileImage('default.png');
           $this->em->persist($user);
           $this->em->flush();
           return $this->redirectToRoute('app_login');
       }
       return $this->render('security/registration.html.twig',[
           'form'=>$form->createView()
       ]);
    }
}
