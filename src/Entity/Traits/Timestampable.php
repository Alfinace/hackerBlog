<?php
/*
 * @Author: your name
 * @Date: 2020-08-06 17:46:54
 * @LastEditTime: 2020-08-06 17:51:32
 * @LastEditors: Please set LastEditors
 * @Description: In User Settings Edit
 * @FilePath: /cours-symfony-container/src/Traits/Timestampable.php
 */

 namespace App\Entity\Traits;

/**
 * 
 */
trait Timestampable
{
     /**
     * @ORM\Column(type="datetime", options={"default":"CURRENT_TIMESTAMP"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", options={"default":"CURRENT_TIMESTAMP"})
     */
    private $updatedAt;


    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updateTimestamps()
    {
        if ($this->getCreatedAt()=== null) {
            $this->setCreatedAt(new \DateTimeImmutable);
        }
        $this->setUpdatedAt(new \DateTimeImmutable);
    }
}
