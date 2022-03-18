<?php

namespace App\Entity;

use App\Repository\ProjetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;

#[ORM\Entity(repositoryClass: ProjetRepository::class)]
class Projet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $Title;

    #[ORM\Column(type: 'text', nullable: true)]
    private $description;

    #[ORM\Column(type: 'date', nullable: true)]
    private $startDate;

    #[ORM\Column(type: 'date', nullable: true)]
    private $endedAt;

    #[ORM\ManyToOne(targetEntity: Status::class, inversedBy: 'projet')]
    private $status;

    #[ORM\ManyToOne(targetEntity: Portfolio::class, inversedBy: 'Projet')]
    private $portfolio;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $code;

    #[ORM\ManyToOne(targetEntity: Budget::class, inversedBy: 'projets')]
    private $Budget;

    #[ORM\OneToMany(mappedBy: 'projet', targetEntity: Risk::class)]
    private $Risk;

    #[ORM\Column(type: 'boolean')]
    private $Done;

    #[ORM\ManyToOne(targetEntity: Team::class, inversedBy: 'Projet')]
    #[ORM\JoinColumn(nullable: false)]
    private $team;

    public function __construct()
    {
        $this->Risk = new ArrayCollection();
    }

    #[Pure] public function __toString(): string
    {
        return (string) $this->getTitle();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): self
    {
        $this->Title = $Title;

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

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(?\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndedAt(): ?\DateTimeInterface
    {
        return $this->endedAt;
    }

    public function setEndedAt(?\DateTimeInterface $endedAt): self
    {
        $this->endedAt = $endedAt;

        return $this;
    }

    public function getStatus(): ?Status
    {
        return $this->status;
    }

    public function setStatus(?Status $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getPortfolio(): ?Portfolio
    {
        return $this->portfolio;
    }

    public function setPortfolio(?Portfolio $portfolio): self
    {
        $this->portfolio = $portfolio;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getBudget(): ?Budget
    {
        return $this->Budget;
    }

    public function setBudget(?Budget $Budget): self
    {
        $this->Budget = $Budget;

        return $this;
    }

    /**
     * @return Collection|Risk[]
     */
    public function getRisk(): Collection
    {
        return $this->Risk;
    }

    public function addRisk(Risk $risk): self
    {
        if (!$this->Risk->contains($risk)) {
            $this->Risk[] = $risk;
            $risk->setProjet($this);
        }

        return $this;
    }

    public function removeRisk(Risk $risk): self
    {
        if ($this->Risk->removeElement($risk)) {
            // set the owning side to null (unless already changed)
            if ($risk->getProjet() === $this) {
                $risk->setProjet(null);
            }
        }

        return $this;
    }

    public function getDone(): ?bool
    {
        return $this->Done;
    }

    public function setDone(bool $Done): self
    {
        $this->Done = $Done;

        return $this;
    }

    public function getTeam(): ?Team
    {
        return $this->team;
    }

    public function setTeam(?Team $team): self
    {
        $this->team = $team;

        return $this;
    }
}
