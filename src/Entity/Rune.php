<?php

namespace App\Entity;

use App\Repository\RuneRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RuneRepository::class)]
class Rune
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $hash;

    #[ORM\Column(type: 'boolean')]
    private $wasUsed;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHash(): ?string
    {
        return $this->hash;
    }

    public function setHash(string $hash): self
    {
        $this->hash = $hash;

        return $this;
    }

    public function getWasUsed(): ?bool
    {
        return $this->wasUsed;
    }

    public function setWasUsed(bool $wasUsed): self
    {
        $this->wasUsed = $wasUsed;

        return $this;
    }
}
