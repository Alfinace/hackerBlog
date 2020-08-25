<?php
/*
 * @Author: your name
 * @Date: 2020-08-23 15:16:36
 * @LastEditTime: 2020-08-23 15:37:55
 * @LastEditors: Please set LastEditors
 * @Description: In User Settings Edit
 * @FilePath: /cours-symfony-container/src/Service/LikeService.php
 */
namespace App\Service;

use App\Entity\Pin;
use App\Entity\Like;
use App\Entity\User;
use App\Repository\LikeRepository;
use Doctrine\ORM\EntityManagerInterface;

class LikeService {
    private $likeRepository;
    private $em;
    public  function __construct(LikeRepository $likeRepository,EntityManagerInterface $em){
        $this->likeRepository = $likeRepository;
        $this->em = $em;
    }

    public function LikeManager(Pin $pin,User $user)
    {
        $isExisted = false;
        foreach ($pin->getLikes() as $like) {
            if ($like->getUser() === $user) {
                $this->likeRepository->deleteLikeById($like->getId());
                // $LikeCount = count($pin->getLikes() );
                // return $this->json(["count"=>$LikeCount,'status'=>'like'],200)
                $isExisted = true;
            }
        }
        if (!$isExisted) {
            $like = new Like;
            $like->setPin($pin)
               ->setUser($user)
               ->setCreatedAt( new \DateTime)
               ->setUpdatedAt( new \DateTime);
           $this->em->persist($like);
           $this->em->flush();
           $isExisted = true;
        }
    return $isExisted;
    }
}