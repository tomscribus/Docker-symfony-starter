<?php

namespace App\Entity;

use App\Repository\ResiliationTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ResiliationTypeRepository::class)
 */
class ResiliationType
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Resiliation::class, mappedBy="resiliation_type")
     */
    private $resiliations;

    public function __construct()
    {
        $this->resiliations = new ArrayCollection();
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

    /**
     * @return Collection|Resiliation[]
     */
    public function getResiliations(): Collection
    {
        return $this->resiliations;
    }

    public function __toString(): string
    {
        return $this->getName();
    }
}
