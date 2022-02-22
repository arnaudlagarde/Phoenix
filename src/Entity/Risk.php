<?php

namespace App\Entity;

use App\Repository\RiskRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RiskRepository::class)]
class Risk
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $Name;

    #[ORM\Column(type: 'datetime')]
    private $IdentificationDate;

    #[ORM\Column(type: 'datetime')]
    private $ResolutionDate;

    #[ORM\Column(type: 'boolean')]
    private $Critical;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $Probability;

    #[ORM\ManyToOne(targetEntity: Projet::class, inversedBy: 'Risk')]
    private $projet;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getIdentificationDate(): ?\DateTimeInterface
    {
        return $this->IdentificationDate;
    }

    public function setIdentificationDate(\DateTimeInterface $IdentificationDate): self
    {
        $this->IdentificationDate = $IdentificationDate;

        return $this;
    }

    public function getResolutionDate(): ?\DateTimeInterface
    {
        return $this->ResolutionDate;
    }

    public function setResolutionDate(\DateTimeInterface $ResolutionDate): self
    {
        $this->ResolutionDate = $ResolutionDate;

        return $this;
    }

    public function getCritical(): ?bool
    {
        return $this->Critical;
    }

    public function setCritical(bool $Critical): self
    {
        $this->Critical = $Critical;

        return $this;
    }

    public function getProbability(): ?string
    {
        return $this->Probability;
    }

    public function setProbability(?string $Probability): self
    {
        $this->Probability = $Probability;

        return $this;
    }

    public function getProjet(): ?Projet
    {
        return $this->projet;
    }

    public function setProjet(?Projet $projet): self
    {
        $this->projet = $projet;

        return $this;
    }
}
