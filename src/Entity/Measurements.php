<?php

namespace App\Entity;

use App\Repository\MeasurementsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MeasurementsRepository::class)]
class Measurements
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $year = null;

    #[ORM\Column]
    private ?int $id_sensor = null;

    #[ORM\Column]
    private ?int $id_wine = null;

    #[ORM\Column(length: 100)]
    private ?string $colour = null;

    #[ORM\Column(length: 100)]
    private ?string $temperature = null;

    #[ORM\Column]
    private ?int $alcohol_content = null;

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

    public function getIdSensor(): ?int
    {
        return $this->id_sensor;
    }

    public function setIdSensor(int $id_sensor): static
    {
        $this->id_sensor = $id_sensor;

        return $this;
    }

    public function getIdWine(): ?int
    {
        return $this->id_wine;
    }

    public function setIdWine(int $id_wine): static
    {
        $this->id_wine = $id_wine;

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

    public function getTemperature(): ?string
    {
        return $this->temperature;
    }

    public function setTemperature(string $temperature): static
    {
        $this->temperature = $temperature;

        return $this;
    }

    public function getAlcoholContent(): ?int
    {
        return $this->alcohol_content;
    }

    public function setAlcoholContent(int $alcohol_content): static
    {
        $this->alcohol_content = $alcohol_content;

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
