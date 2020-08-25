<?php
/*
 * @Author: your name
 * @Date: 2020-08-23 16:18:03
 * @LastEditTime: 2020-08-23 16:19:20
 * @LastEditors: Please set LastEditors
 * @Description: In User Settings Edit
 * @FilePath: /cours-symfony-container/src/Entity/Language.php
 */

namespace App\Entity;

use App\Entity\Traits\Timestampable;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LanguageRepository")
 * @ORM\Table(name="languages")
 */
class Language
{
    use Timestampable;
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $lire;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $lecture;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $orale;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Profile", inversedBy="language")
     */
    private $profile;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getLire(): ?string
    {
        return $this->lire;
    }

    public function setLire(string $lire): self
    {
        $this->lire = $lire;

        return $this;
    }

    public function getLecture(): ?string
    {
        return $this->lecture;
    }

    public function setLecture(string $lecture): self
    {
        $this->lecture = $lecture;

        return $this;
    }

    public function getOrale(): ?string
    {
        return $this->orale;
    }

    public function setOrale(string $orale): self
    {
        $this->orale = $orale;

        return $this;
    }

    public function getProfile(): ?Profile
    {
        return $this->profile;
    }

    public function setProfile(?Profile $profile): self
    {
        $this->profile = $profile;

        return $this;
    }
}
