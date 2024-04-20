<?php

namespace App\Entity;

use App\Repository\ModuleIOTRepository;
use App\utils\TimestampableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ModuleIOTRepository::class)
 * @UniqueEntity(fields = {"name"},message ="Il existe déjà un module IOT portant ce nom")
 */
class ModuleIOT
{
    use TimestampableTrait;
    
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"data_IOT"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"data_IOT"})
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=TypeModuleIOT::class, inversedBy="moduleIOTs")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank(message="Vous devez choisir un type pour ce module IOT")
     * @Groups({"data_IOT"})
     */
    private $type;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"data_IOT"})
     */
    private $isActive;

    /**
     * @ORM\OneToMany(targetEntity=DataModuleIOT::class, mappedBy="module", orphanRemoval=true)
     * @Groups({"data_IOT"})
     */
    private $dataModuleIOTs;

    public function __construct()
    {
        $this->dataModuleIOTs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getType(): ?TypeModuleIOT
    {
        return $this->type;
    }

    public function setType(?TypeModuleIOT $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function isIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * @return Collection<int, DataModuleIOT>
     */
    public function getDataModuleIOTs(): Collection
    {
        return $this->dataModuleIOTs;
    }

    public function addDataModuleIOT(DataModuleIOT $dataModuleIOT): self
    {
        if (!$this->dataModuleIOTs->contains($dataModuleIOT)) {
            $this->dataModuleIOTs[] = $dataModuleIOT;
            $dataModuleIOT->setModule($this);
        }

        return $this;
    }

    public function removeDataModuleIOT(DataModuleIOT $dataModuleIOT): self
    {
        if ($this->dataModuleIOTs->removeElement($dataModuleIOT)) {
            // set the owning side to null (unless already changed)
            if ($dataModuleIOT->getModule() === $this) {
                $dataModuleIOT->setModule(null);
            }
        }

        return $this;
    }
}
