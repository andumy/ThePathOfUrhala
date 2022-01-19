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

    #[ORM\Column(type: 'string', length: 255)]
    private $firstIngredient;

    #[ORM\Column(type: 'string', length: 255)]
    private $secondIngredient;

    #[ORM\Column(type: 'string', length: 255)]
    private $result;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $effect;

    #[ORM\Column(type: 'boolean')]
    private $capped;

    #[ORM\Column(type: 'integer')]
    private $deto;

    #[ORM\Column(type: 'integer')]
    private $mozo;

    #[ORM\Column(type: 'integer')]
    private $ruto;

    #[ORM\Column(type: 'integer')]
    private $crylo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstIngredient(): ?string
    {
        return $this->firstIngredient;
    }

    public function setFirstIngredient(string $firstIngredient): self
    {
        $this->firstIngredient = $firstIngredient;

        return $this;
    }

    public function getSecondIngredient(): ?string
    {
        return $this->secondIngredient;
    }

    public function setSecondIngredient(string $secondIngredient): self
    {
        $this->secondIngredient = $secondIngredient;

        return $this;
    }

    public function getResult(): ?string
    {
        return $this->result;
    }

    public function setResult(string $result): self
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

    public function getCapped(): ?bool
    {
        return $this->capped;
    }

    public function setCapped(bool $capped): self
    {
        $this->capped = $capped;

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
}
