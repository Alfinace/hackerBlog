<?php
/*
 * @Author: your name
 * @Date: 2020-08-04 23:30:31
 * @LastEditTime: 2020-08-17 14:22:50
 * @LastEditors: Please set LastEditors
 * @Description: In User Settings Edit
 * @FilePath: /cours-symfony-container/src/Controller/PinsController.php
 */

namespace App\Controller;

use App\Entity\Pin;
use App\Entity\Like;
use App\Form\PinType;
use App\Service\ImageUploader;
use App\Repository\PinRepository;
use App\Repository\LikeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PinController extends AbstractController
{
    /**
     * @Route("/", name="app_index_pin")
     * 
     * @param PinRepository $pinRepository
     * @return Response
     */
    public function index(PinRepository $pinRepository): Response
    {
        return $this->render('pins/index.html.twig', [
            'pins' => $pinRepository->findBy([], ['createdAt' => 'DESC'])
        ]);
    }

    /**
     * @Route("/pins/show/{id<[0-9]+>}", name="app_show_pin",methods={"GET"})
     *
     * @param Pin $pin
     * @return Response
     */
    public function show(Pin $pin): Response
    {
        return $this->render('pins/show.html.twig', compact("pin"));
    }

    /**
     * @Route("/pins/create", name="app_create_pin",methods={"GET","POST"})
     *
     * @return Response
     */
    public function create(Request $request, EntityManagerInterface $em, ImageUploader $imageUploader): Response
    {
       if (!$this->getUser()) {
           $this->addFlash(
           'warning',
           'Connectez-vous d\'abord'
           );
           return $this->redirectToRoute('app_login');
       }
        $pin = new Pin();
        $form = $this->createForm(PinType::class, $pin);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = ($request->files->get('pin'))['imageName'];
            if ($imageFile) {
                $imageFileName = $imageUploader->upload($imageFile);
                $pin->setImageName($imageFileName);
            }
            //$pin = $form->getData(); 
            $pin->setUser($this->getUser());
            $em->persist($pin);
            $em->flush();
            $this->addFlash(
                'success',
                'Pin successfully created'
            );
            return $this->redirectToRoute('app_index_pin');
        }

        return $this->render('pins/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/pins/{id<[0-9]+>}/edit", name="app_edit_pin", methods={"GET","PUT"})
     *
     * @param Request $request
     * @param Pin $pin
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function edit(PinRepository $pinRepository, Request $request, Pin $pin, EntityManagerInterface $em, ImageUploader $imageUploader, Filesystem $filesystem): Response
    {
    
        if ($this->getUser() != $pin->getUser()) {
            $this->addFlash(
            'warning',
            'Attention, You \'re baned to make this action'
            );
           return $this->redirectToRoute('app_index_pin');
        }
        $pinOld = $pinRepository->find($pin->getId());
        $form = $this->createForm(PinType::class, $pin, [
            'method' => 'PUT'
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = ($request->files->get('pin'))['imageName'];
            if (!is_null($imageFile)) {
                if (!is_null($pinOld->getImageName())) {
                    $filesystem->remove($this->getParameter('images_directory') . '/' . $pinOld->getImageName());
                }
                $imageFileName = $imageUploader->upload($imageFile);
                $pin->setImageName($imageFileName);
            }

            $em->persist($pin);
            $em->flush();
            $this->addFlash(
                'success',
                'Pin successfully updated'
            );
            return $this->redirectToRoute('app_index_pin');
        }

        return $this->render('pins/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/pins/{id<[0-9]+>}", name="app_delete_pin", methods={"GET","DELETE"})
     *
     * @param Pin $pin
     * @param EntityManagerInterface $em
     * @return void
     */
    public function remove(Request $request, Pin $pin, EntityManagerInterface $em, Filesystem $filesystem)
    {
        $title = $pin->getTitle();
        if ($this->isCsrfTokenValid('pin.delete' . $pin->getId(), $request->request->get('csrf_token'))) {
            $filesystem->remove($this->getParameter('images_directory') . '/' . $pin->getImageName());
            $em->remove($pin);
            $em->flush();
            $this->addFlash(
                'danger',
                'Pin "' . $title . '" deleted'
            );
        }
        return $this->redirectToRoute('app_index_pin');
    }

    /**
     * @Route("/pins/{id<[0-9]+>}/like", name="app_delete_like")
     * set our remove  like
     *
     * @param Pin $pin
     * @return Response
     */
    public function Like(Pin $pin, LikeRepository $likeRepository, EntityManagerInterface $em):Response 
    {
    $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
      foreach ($pin->getLikes() as $like) {
         if ($like->getUser() === $this->getUser()) {
            $likeRepository->deleteLikeById($like->getId());
            return $this->redirectToRoute('app_index_pin');
         }
      }
         $like = new Like;
         $like->setPin($pin)
            ->setUser($this->getUser())
            ->setCreatedAt( new \DateTime)
            ->setUpdatedAt( new \DateTime);
        $em->persist($like);
        $em->flush();
      return $this->redirectToRoute('app_index_pin');
    }
}