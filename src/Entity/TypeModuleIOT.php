<?php

namespace App\Entity;

use App\Repository\TypeModuleIOTRepository;
use App\utils\TimestampableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=TypeModuleIOTRepository::class)
 * @UniqueEntity(fields = {"name"},message ="Il existe déjà un type de module IOT portant ce nom")
 */
class TypeModuleIOT
{
    use TimestampableTrait;
    
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Vous devez choisir un nom pour ce type de module IOT")
     * @Groups({"data_IOT"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"data_IOT"})
     */
    private $dataName1 = 'on/off';

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"data_IOT"})
     * @Assert\NotBlank(message="Vous devez renseigner au moins une propriété")
     */
    private $dataName2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"data_IOT"})
     */
    private $dataName3;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"data_IOT"})
     */
    private $dataName4;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"data_IOT"})
     */
    private $dataName5;

    /**
     * @ORM\OneToMany(targetEntity=ModuleIOT::class, mappedBy="type", orphanRemoval=true)
     */
    private $moduleIOTs;

    public function __construct()
    {
        $this->moduleIOTs = new ArrayCollection();
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

    public function getDataName1(): ?string
    {
        return $this->dataName1;
    }

    public function setDataName1(?string $dataName1): self
    {
        $this->dataName1 = $dataName1;

        return $this;
    }

    public function getDataName2(): ?string
    {
        return $this->dataName2;
    }

    public function setDataName2(?string $dataName2): self
    {
        $this->dataName2 = $dataName2;

        return $this;
    }

    public function getDataName3(): ?string
    {
        return $this->dataName3;
    }

    public function setDataName3(?string $dataName3): self
    {
        $this->dataName3 = $dataName3;

        return $this;
    }

    public function getDataName4(): ?string
    {
        return $this->dataName4;
    }

    public function setDataName4(?string $dataName4): self
    {
        $this->dataName4 = $dataName4;

        return $this;
    }

    public function getDataName5(): ?string
    {
        return $this->dataName5;
    }

    public function setDataName5(?string $dataName5): self
    {
        $this->dataName5 = $dataName5;

        return $this;
    }

    /**
     * @return Collection<int, ModuleIOT>
     */
    public function getModuleIOTs(): Collection
    {
        return $this->moduleIOTs;
    }

    public function addModuleIOT(ModuleIOT $moduleIOT): self
    {
        if (!$this->moduleIOTs->contains($moduleIOT)) {
            $this->moduleIOTs[] = $moduleIOT;
            $moduleIOT->setType($this);
        }

        return $this;
    }

    public function removeModuleIOT(ModuleIOT $moduleIOT): self
    {
        if ($this->moduleIOTs->removeElement($moduleIOT)) {
            // set the owning side to null (unless already changed)
            if ($moduleIOT->getType() === $this) {
                $moduleIOT->setType(null);
            }
        }

        return $this;
    }
}
