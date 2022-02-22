<?php

namespace App\Entity;

use App\Repository\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TagRepository::class)]
class Tag
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'integer')]
    private $value;

    #[ORM\Column(type: 'boolean')]
    private $Mandatory;

    #[ORM\OneToMany(mappedBy: 'Tag', targetEntity: CrucialFact::class)]
    private $crucialFacts;

    public function __construct()
    {
        $this->crucialFacts = new ArrayCollection();
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

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function setValue(int $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getMandatory(): ?bool
    {
        return $this->Mandatory;
    }

    public function setMandatory(bool $Mandatory): self
    {
        $this->Mandatory = $Mandatory;

        return $this;
    }

    /**
     * @return Collection|CrucialFact[]
     */
    public function getCrucialFacts(): Collection
    {
        return $this->crucialFacts;
    }

    public function addCrucialFact(CrucialFact $crucialFact): self
    {
        if (!$this->crucialFacts->contains($crucialFact)) {
            $this->crucialFacts[] = $crucialFact;
            $crucialFact->setTag($this);
        }

        return $this;
    }

    public function removeCrucialFact(CrucialFact $crucialFact): self
    {
        if ($this->crucialFacts->removeElement($crucialFact)) {
            // set the owning side to null (unless already changed)
            if ($crucialFact->getTag() === $this) {
                $crucialFact->setTag(null);
            }
        }

        return $this;
    }
}
