<?php
/*
 * @Author: your name
 * @Date: 2020-08-04 23:30:31
 * @LastEditTime: 2020-08-06 17:37:40
 * @LastEditors: Please set LastEditors
 * @Description: In User Settings Edit
 * @FilePath: /cours-symfony-container/src/Controller/PinController.php
 */

namespace App\Controller;

use App\Entity\Pin;
use App\Repository\PinRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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
        return $this->render('pin/index.html.twig', [
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
        
        return $this->render('pin/show.html.twig',compact("pin"));
    }
}
