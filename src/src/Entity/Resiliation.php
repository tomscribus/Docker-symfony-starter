<?php

namespace App\Entity;

use App\Repository\ResiliationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ResiliationRepository::class)
 */
class Resiliation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Mandat::class, inversedBy="resiliation", cascade={"persist", "remove"})
     */
    public $mandat;

    /**
     * @ORM\ManyToOne(targetEntity=ResiliationType::class, inversedBy="resiliations")
     * @ORM\JoinColumn(nullable=false)
     */
    public $resiliation_type;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    public $start_date;

    /**
     * @ORM\Column(type="string")
     */
    private $status;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMandat(): ?Mandat
    {
        return $this->mandat;
    }

    public function setMandat(?Mandat $mandat): self
    {
        $this->mandat = $mandat;

        return $this;
    }

    public function getResiliationType(): ?ResiliationType
    {
        return $this->resiliation_type;
    }

    public function setResiliationType(?ResiliationType $resiliation_type): self
    {
        $this->resiliation_type = $resiliation_type;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->start_date;
    }

    public function setStartDate(\DateTimeInterface $start_date): self
    {
        $this->start_date = $start_date;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }
}
