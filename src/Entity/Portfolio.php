<?php

namespace App\Entity;

use App\Repository\PortfolioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PortfolioRepository::class)]
class Portfolio
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'portfolio', targetEntity: Projet::class)]
    private $Projet;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'portfolios')]
    #[ORM\JoinColumn(nullable: false)]
    private $Responsible;

    #[ORM\ManyToOne(targetEntity: Admin::class, inversedBy: 'portfolios')]
    private $Boss;

    public function __construct()
    {
        $this->Projet = new ArrayCollection();
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
     * @return Collection|Projet[]
     */
    public function getProjet(): Collection
    {
        return $this->Projet;
    }

    public function addProjet(Projet $projet): self
    {
        if (!$this->Projet->contains($projet)) {
            $this->Projet[] = $projet;
            $projet->setPortfolio($this);
        }

        return $this;
    }

    public function removeProjet(Projet $projet): self
    {
        if ($this->Projet->removeElement($projet)) {
            // set the owning side to null (unless already changed)
            if ($projet->getPortfolio() === $this) {
                $projet->setPortfolio(null);
            }
        }

        return $this;
    }

    public function getResponsible(): ?User
    {
        return $this->Responsible;
    }

    public function setResponsible(?User $Responsible): self
    {
        $this->Responsible = $Responsible;

        return $this;
    }

    public function getBoss(): ?Admin
    {
        return $this->Boss;
    }

    public function setBoss(?Admin $Boss): self
    {
        $this->Boss = $Boss;

        return $this;
    }
}
