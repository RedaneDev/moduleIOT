<?php

namespace App\Entity;

use App\Repository\DataModuleIOTRepository;
use App\utils\TimestampableTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=DataModuleIOTRepository::class)
 */
class DataModuleIOT
{
    use TimestampableTrait;
    
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=ModuleIOT::class, inversedBy="dataModuleIOTs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $module;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups({"data_IOT"})
     * @Groups({"data_IOT_only"})
     */
    private $data1;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups({"data_IOT"})
     * @Groups({"data_IOT_only"})
     */
    private $data2;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups({"data_IOT"})
     * @Groups({"data_IOT_only"})
     */
    private $data3;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups({"data_IOT"})
     * @Groups({"data_IOT_only"})
     */
    private $data4;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups({"data_IOT"})
     * @Groups({"data_IOT_only"})
     */
    private $data5;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModule(): ?ModuleIOT
    {
        return $this->module;
    }

    public function setModule(?ModuleIOT $module): self
    {
        $this->module = $module;

        return $this;
    }

    public function getData1(): ?float
    {
        return $this->data1;
    }

    public function setData1(?float $data1): self
    {
        $this->data1 = $data1;

        return $this;
    }

    public function getData2(): ?float
    {
        return $this->data2;
    }

    public function setData2(?float $data2): self
    {
        $this->data2 = $data2;

        return $this;
    }

    public function getData3(): ?float
    {
        return $this->data3;
    }

    public function setData3(?float $data3): self
    {
        $this->data3 = $data3;

        return $this;
    }

    public function getData4(): ?float
    {
        return $this->data4;
    }

    public function setData4(?float $data4): self
    {
        $this->data4 = $data4;

        return $this;
    }

    public function getData5(): ?float
    {
        return $this->data5;
    }

    public function setData5(?float $data5): self
    {
        $this->data5 = $data5;

        return $this;
    }
}
