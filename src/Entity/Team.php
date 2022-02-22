<?php

namespace App\Entity;

use App\Repository\TeamRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TeamRepository::class)]
class Team
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'team', targetEntity: User::class)]
    private $responsible;

    #[ORM\OneToMany(mappedBy: 'team', targetEntity: user::class)]
    private $member;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'LeadTeam')]
    private $team;

    public function __construct()
    {
        $this->responsible = new ArrayCollection();
        $this->member = new ArrayCollection();
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
     * @return Collection|User[]
     */
    public function getResponsible(): Collection
    {
        return $this->responsible;
    }

    public function addResponsible(User $responsible): self
    {
        if (!$this->responsible->contains($responsible)) {
            $this->responsible[] = $responsible;
            $responsible->setTeam($this);
        }

        return $this;
    }

    public function removeResponsible(User $responsible): self
    {
        if ($this->responsible->removeElement($responsible)) {
            // set the owning side to null (unless already changed)
            if ($responsible->getTeam() === $this) {
                $responsible->setTeam(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|user[]
     */
    public function getMember(): Collection
    {
        return $this->member;
    }

    public function addMember(user $member): self
    {
        if (!$this->member->contains($member)) {
            $this->member[] = $member;
            $member->setTeam($this);
        }

        return $this;
    }

    public function removeMember(user $member): self
    {
        if ($this->member->removeElement($member)) {
            // set the owning side to null (unless already changed)
            if ($member->getTeam() === $this) {
                $member->setTeam(null);
            }
        }

        return $this;
    }

    public function getTeam(): ?self
    {
        return $this->team;
    }

    public function setTeam(?self $team): self
    {
        $this->team = $team;

        return $this;
    }
}
