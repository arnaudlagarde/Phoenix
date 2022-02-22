<?php

namespace App\Entity;

use App\Repository\BudgetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BudgetRepository::class)]
class Budget
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'float')]
    private $InitialValue;

    #[ORM\Column(type: 'float')]
    private $ConsumedValue;

    #[ORM\Column(type: 'float')]
    private $RemainingBudget;

    #[ORM\Column(type: 'float')]
    private $TurnoverBudget;

    #[ORM\OneToMany(mappedBy: 'Budget', targetEntity: Projet::class)]
    private $projets;

    public function __construct()
    {
        $this->projets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInitialValue(): ?float
    {
        return $this->InitialValue;
    }

    public function setInitialValue(float $InitialValue): self
    {
        $this->InitialValue = $InitialValue;

        return $this;
    }

    public function getConsumedValue(): ?float
    {
        return $this->ConsumedValue;
    }

    public function setConsumedValue(float $ConsumedValue): self
    {
        $this->ConsumedValue = $ConsumedValue;

        return $this;
    }

    public function getRemainingBudget(): ?float
    {
        return $this->RemainingBudget;
    }

    public function setRemainingBudget(float $RemainingBudget): self
    {
        $this->RemainingBudget = $RemainingBudget;

        return $this;
    }

    public function getTurnoverBudget(): ?float
    {
        return $this->TurnoverBudget;
    }

    public function setTurnoverBudget(float $TurnoverBudget): self
    {
        $this->TurnoverBudget = $TurnoverBudget;

        return $this;
    }

    /**
     * @return Collection|Projet[]
     */
    public function getProjets(): Collection
    {
        return $this->projets;
    }

    public function addProjet(Projet $projet): self
    {
        if (!$this->projets->contains($projet)) {
            $this->projets[] = $projet;
            $projet->setBudget($this);
        }

        return $this;
    }

    public function removeProjet(Projet $projet): self
    {
        if ($this->projets->removeElement($projet)) {
            // set the owning side to null (unless already changed)
            if ($projet->getBudget() === $this) {
                $projet->setBudget(null);
            }
        }

        return $this;
    }
}
