<?php
/*
 * @Author: your name
 * @Date: 2020-08-04 23:30:31
 * @LastEditTime: 2020-08-07 21:00:04
 * @LastEditors: Please set LastEditors
 * @Description: In User Settings Edit
 * @FilePath: /cours-symfony-container/src/Controller/PinController.php
 */

namespace App\Controller;

use App\Entity\Pin;
use App\Form\PinType;
use Faker\Provider\ar_JO\Text;
use App\Repository\PinRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PinController extends AbstractController
{
    /**
     * @Route("/", name="app_index_pin")
     * 
     * @param PinRepository $pinRepository
     * @return Response
     */
    public function index(PinRepository $pinRepository):Response
    {
        return $this->render('pins/index.html.twig', [
            'pins' => $pinRepository->findBy([],['createdAt'=>'DESC'])
        ]);
    }
    
    /**
     * @Route("/show/{id<[0-9]+>}", name="app_show_pin",methods={"GET"})
     *
     * @param Pin $pin
     * @return Response
     */
    public function show(Pin $pin):Response
    {
        
        return $this->render('pins/show.html.twig',compact("pin"));
    }

    /**
     * @Route("/create", name="app_create_pin",methods={"GET","POST"})
     *
     * @return Response
     */
    public function create(Request $request,EntityManagerInterface $em):Response
    {
        $pin = new Pin;
        $form = $this->createForm(PinType::class, $pin);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //$pin = $form->getData(); 
            $em->persist($pin);
            $em->flush(); 
        return $this->redirectToRoute('app_index_pin');
        }

        return $this->render('pins/create.html.twig',[
            'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/pin/{id<[0-9]+>}/edit", name="app_edit_pin", methods={"GET","PUT"})
     *
     * @param Request $request
     * @param Pin $pin
     * @param EntityManagerInterface $em
     * @return Response
    */
    public function edit(Request $request, Pin $pin, EntityManagerInterface $em ):Response
    {
        $form = $this->createForm(PinType::class, $pin,[
            'method' =>'PUT'
        ]);
        $form->handleRequest($request);
         if ($form->isSubmitted() && $form->isValid()) { 
            $em->persist($pin);
            $em->flush();
            return $this->redirectToRoute('app_index_pin');
         }

        return $this->render('pins/edit.html.twig',[
            'form'=>$form->createView()
        ]);
    }
/**
 * @Route("pin/{id<[0-9]+>}/delete", name="app_delete_pin", methods={"GET","DELETE"})
 *
 * @param Pin $pin
 * @param EntityManagerInterface $em
 * @return void
 */
    public function remove(Request $request, Pin $pin, EntityManagerInterface $em)
    {
        if ($this->isCsrfTokenValid('pin.delete'.$pin->getId(),$request->request->get('csrf_token'))) {
            $em->remove($pin);
            $em->flush();
        }
        return $this->redirectToRoute('app_index_pin');
    }
}