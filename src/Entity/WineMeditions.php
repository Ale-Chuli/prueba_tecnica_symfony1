<?php

namespace App\Entity;

use App\Repository\WineMeditionsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WineMeditionsRepository::class)]
class WineMeditions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $year = null;

    #[ORM\Column]
    private ?int $idsensor = null;

    #[ORM\Column]
    private ?int $idwine = null;

    #[ORM\Column(length: 100)]
    private ?string $colour = null;

    #[ORM\Column]
    private ?int $alcohol_percentage = null;

    #[ORM\Column]
    private ?int $ph = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): static
    {
        $this->year = $year;

        return $this;
    }

    public function getIdsensor(): ?int
    {
        return $this->idsensor;
    }

    public function setIdsensor(int $idsensor): static
    {
        $this->idsensor = $idsensor;

        return $this;
    }

    public function getIdwine(): ?int
    {
        return $this->idwine;
    }

    public function setIdwine(int $idwine): static
    {
        $this->idwine = $idwine;

        return $this;
    }

    public function getColour(): ?string
    {
        return $this->colour;
    }

    public function setColour(string $colour): static
    {
        $this->colour = $colour;

        return $this;
    }

    public function getAlcoholPercentage(): ?int
    {
        return $this->alcohol_percentage;
    }

    public function setAlcoholPercentage(int $alcohol_percentage): static
    {
        $this->alcohol_percentage = $alcohol_percentage;

        return $this;
    }

    public function getPh(): ?int
    {
        return $this->ph;
    }

    public function setPh(int $ph): static
    {
        $this->ph = $ph;

        return $this;
    }
}
