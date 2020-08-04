<?php
/*
 * @Author: your name
 * @Date: 2020-08-04 23:30:31
 * @LastEditTime: 2020-08-05 00:44:32
 * @LastEditors: Please set LastEditors
 * @Description: In User Settings Edit
 * @FilePath: /cours-symfony-container/src/Controller/PinController.php
 */

namespace App\Controller;

use App\Repository\PinRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PinController extends AbstractController
{
    /**
     * @Route("/pin", name="pin")
     */
    public function index(PinRepository $pinRepository)
    {
        return $this->render('pin/index.html.twig', [
            'pins' => $pinRepository->findAll()
        ]);
    }
}
