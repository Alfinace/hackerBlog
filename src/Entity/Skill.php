<?php
/*
 * @Author: your name
 * @Date: 2020-08-23 16:29:41
 * @LastEditTime: 2020-08-23 16:32:04
 * @LastEditors: Please set LastEditors
 * @Description: In User Settings EditORM\
 * @FilePath: /cours-symfony-container/src/Entity/Skill.php
 */

namespace App\Entity;

use App\Entity\Traits\Timestampable;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SkillRepository")
 * @ORM\Table(name="skills")
 */
class Skill
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
     * @ORM\Column(type="array")
     */
    private $details = [];

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Profile", inversedBy="skills")
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

    public function getDetails(): ?array
    {
        return $this->details;
    }

    public function setDetails(array $details): self
    {
        $this->details = $details;

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
