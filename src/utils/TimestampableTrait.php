<?php
namespace App\utils;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

trait TimestampableTrait
{
    /**
     * @ORM\Column(type="datetime", nullable=false)
     * @Groups({"data_IOT"})
     * @Groups({"data_IOT_only"})
     */
    protected $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"data_IOT"})
     * @Groups({"data_IOT_only"})
     */
    protected $updatedAt;

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        $this->createdAt = new DateTime();
    }

    /**
     * @ORM\PreUpdate
     */
    public function preUpdate()
    {
        $this->updatedAt = new DateTime();
    }
}