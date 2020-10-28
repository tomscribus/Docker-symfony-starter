<?php

namespace App\Entity;

use App\Repository\MandatRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MandatRepository::class)
 */
class Mandat
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Client::class, inversedBy="mandat", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    public $client;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creation_date;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="mandats")
     * @ORM\JoinColumn(nullable=false)
     */
    private $broker;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $document;

    /**
     * @ORM\OneToOne(targetEntity=Resiliation::class, inversedBy="mandat")
     */
    private $resiliation;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_signed;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creation_date;
    }

    public function setCreationDate(\DateTimeInterface $creation_date): self
    {
        $this->creation_date = $creation_date;

        return $this;
    }

    public function getBroker(): ?User
    {
        return $this->broker;
    }

    public function setBroker(?User $broker): self
    {
        $this->broker = $broker;

        return $this;
    }

    public function getDocument(): ?string
    {
        return $this->document;
    }

    public function setDocument(string $document): self
    {
        $this->document = $document;

        return $this;
    }

    public function getResiliation(): ?Resiliation
    {
        return $this->resiliation;
    }

    public function setResiliation(?Resiliation $resiliation): self
    {
        $this->resiliation = $resiliation;

        return $this;
    }

    public function getIsSigned(): ?bool
    {
        return $this->is_signed;
    }

    public function setIsSigned(bool $is_signed): self
    {
        $this->is_signed = $is_signed;

        return $this;
    }
}
