<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ClientRepository::class)
 */
class Client
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"show_client"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"show_client"})
     */
    public $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"show_client"})
     */
    public $surname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"show_client"})
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"show_client"})
     */
    private $email;

    /**
     * @ORM\OneToOne(targetEntity=Mandat::class, mappedBy="client", cascade={"persist", "remove"})
     * @Groups({"show_client"})
     */
    private $mandat;

    /**
     * @ORM\ManyToOne(targetEntity=Insurer::class, inversedBy="clients")
     */
    public $insurer;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $siret;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $legal_name;

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

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }


    public function getMandat(): ?Mandat
    {
        return $this->mandat;
    }

    public function setMandat(Mandat $mandat): self
    {
        $this->mandat = $mandat;

        // set the owning side of the relation if necessary
        if ($mandat->getClient() !== $this) {
            $mandat->setClient($this);
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getName().' '.$this->getSurname();
    }

    public function getInsurer(): ?Insurer
    {
        return $this->insurer;
    }

    public function setInsurer(?Insurer $insurer): self
    {
        $this->insurer = $insurer;

        return $this;
    }

    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function setSiret(?string $siret): self
    {
        $this->siret = $siret;

        return $this;
    }

    public function getLegalName(): ?string
    {
        return $this->legal_name;
    }

    public function setLegalName(?string $legal_name): self
    {
        $this->legal_name = $legal_name;

        return $this;
    }
}
