<?php

namespace App\Entity;

use App\Repository\CrucialFactRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CrucialFactRepository::class)]
class CrucialFact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'datetime')]
    private $DateFact;

    #[ORM\Column(type: 'text', nullable: true)]
    private $description;

    #[ORM\ManyToOne(targetEntity: Milestone::class, inversedBy: 'CrucialFacts')]
    private $Milestone;

    #[ORM\ManyToOne(targetEntity: Projet::class, inversedBy: 'CrucialFact')]
    private $projet;

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

    public function getDateFact(): ?\DateTimeInterface
    {
        return $this->DateFact;
    }

    public function setDateFact(\DateTimeInterface $DateFact): self
    {
        $this->DateFact = $DateFact;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getMilestone(): ?Milestone
    {
        return $this->Milestone;
    }

    public function setMilestone(?Milestone $Milestone): self
    {
        $this->Milestone = $Milestone;

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
