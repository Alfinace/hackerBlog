<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ParcoursRepository")
 */
class Parcours
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="dateinterval")
     */
    private $periode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $detail;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Profile", inversedBy="parcours")
     */
    private $profile;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPeriode(): ?\DateInterval
    {
        return $this->periode;
    }

    public function setPeriode(\DateInterval $periode): self
    {
        $this->periode = $periode;

        return $this;
    }

    public function getDetail(): ?string
    {
        return $this->detail;
    }

    public function setDetail(string $detail): self
    {
        $this->detail = $detail;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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
