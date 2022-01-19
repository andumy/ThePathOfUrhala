<?php

namespace App\Entity;

use App\Repository\ElementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ElementRepository::class)]
class Element
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'firstIngredient', targetEntity: Combo::class)]
    private $combos;

    #[ORM\Column(type: 'boolean')]
    private $isCapped;

    public function __construct()
    {
        $this->combos = new ArrayCollection();
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
     * @return Collection|Combo[]
     */
    public function getCombos(): Collection
    {
        return $this->combos;
    }

    public function addCombo(Combo $combo): self
    {
        if (!$this->combos->contains($combo)) {
            $this->combos[] = $combo;
            $combo->setFirstIngredient($this);
        }

        return $this;
    }

    public function removeCombo(Combo $combo): self
    {
        if ($this->combos->removeElement($combo)) {
            // set the owning side to null (unless already changed)
            if ($combo->getFirstIngredient() === $this) {
                $combo->setFirstIngredient(null);
            }
        }

        return $this;
    }

    public function getIsCapped(): ?bool
    {
        return $this->isCapped;
    }

    public function setIsCapped(bool $isCapped): self
    {
        $this->isCapped = $isCapped;

        return $this;
    }
}
