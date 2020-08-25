<?php
/*
 * @Author: your name
 * @Date: 2020-08-17 14:11:36
 * @LastEditTime: 2020-08-17 14:13:25
 * @LastEditors: Please set LastEditors
 * @Description: In User Settings Edit
 * @FilePath: /cours-symfony-container/src/Entity/Like.php
 */

namespace App\Entity;

use App\Entity\Traits\Timestampable;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LikeRepository")
 * @ORM\Table(name="likes")
 */
class Like
{
    use Timestampable;
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="likes")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Pin", inversedBy="likes")
     */
    private $pin;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getPin(): ?Pin
    {
        return $this->pin;
    }

    public function setPin(?Pin $pin): self
    {
        $this->pin = $pin;

        return $this;
    }
}
