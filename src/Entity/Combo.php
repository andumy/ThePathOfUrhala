<?php

namespace App\Entity;

use App\Repository\ComboRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ComboRepository::class)]
class Combo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Element::class, inversedBy: 'combos')]
    #[ORM\JoinColumn(nullable: false)]
    private $firstIngredient;

    #[ORM\ManyToOne(targetEntity: Element::class, inversedBy: 'combos')]
    #[ORM\JoinColumn(nullable: false)]
    private $secondIngredient;

    #[ORM\ManyToOne(targetEntity: Element::class, inversedBy: 'combos')]
    #[ORM\JoinColumn(nullable: false)]
    private $result;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $effect;

    #[ORM\Column(type: 'boolean')]
    private $isCapped;

    #[ORM\Column(type: 'integer')]
    private $deto;

    #[ORM\Column(type: 'integer')]
    private $mozo;

    #[ORM\Column(type: 'integer')]
    private $ruto;

    #[ORM\Column(type: 'integer')]
    private $crylo;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $cooldown;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstIngredient(): ?Element
    {
        return $this->firstIngredient;
    }

    public function setFirstIngredient(?Element $firstIngredient): self
    {
        $this->firstIngredient = $firstIngredient;

        return $this;
    }

    public function getSecondIngredient(): ?Element
    {
        return $this->secondIngredient;
    }

    public function setSecondIngredient(?Element $secondIngredient): self
    {
        $this->secondIngredient = $secondIngredient;

        return $this;
    }

    public function getResult(): ?Element
    {
        return $this->result;
    }

    public function setResult(?Element $result): self
    {
        $this->result = $result;

        return $this;
    }

    public function getEffect(): ?string
    {
        return $this->effect;
    }

    public function setEffect(?string $effect): self
    {
        $this->effect = $effect;

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

    public function getDeto(): ?int
    {
        return $this->deto;
    }

    public function setDeto(int $deto): self
    {
        $this->deto = $deto;

        return $this;
    }

    public function getMozo(): ?int
    {
        return $this->mozo;
    }

    public function setMozo(int $mozo): self
    {
        $this->mozo = $mozo;

        return $this;
    }

    public function getRuto(): ?int
    {
        return $this->ruto;
    }

    public function setRuto(int $ruto): self
    {
        $this->ruto = $ruto;

        return $this;
    }

    public function getCrylo(): ?int
    {
        return $this->crylo;
    }

    public function setCrylo(int $crylo): self
    {
        $this->crylo = $crylo;

        return $this;
    }

    public function getCooldown(): ?string
    {
        return $this->cooldown;
    }

    public function setCooldown(?string $cooldown): self
    {
        $this->cooldown = $cooldown;

        return $this;
    }
}
