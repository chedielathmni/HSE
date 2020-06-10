<?php

namespace App\Entity;

use App\Repository\HistoryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HistoryRepository::class)
 */
class History
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $beginAt;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $endAt;

    /**
     * @ORM\ManyToOne(targetEntity=Transporter::class, inversedBy="history")
     * @ORM\JoinColumn(nullable=false)
     */
    private $driver;

    /**
     * @ORM\ManyToOne(targetEntity=Car::class, inversedBy="history")
     * @ORM\JoinColumn(nullable=false)
     */
    private $car;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBeginAt(): ?\DateTimeInterface
    {
        return $this->beginAt;
    }

    public function setBeginAt(\DateTimeInterface $beginAt): self
    {
        $this->beginAt = $beginAt;

        return $this;
    }

    public function getEndAt(): ?\DateTimeInterface
    {
        return $this->endAt;
    }

    public function setEndAt(?\DateTimeInterface $endAt): self
    {
        $this->endAt = $endAt;

        return $this;
    }

    public function getDriver(): ?Transporter
    {
        return $this->driver;
    }

    public function setDriver(?Transporter $driver): self
    {
        $this->driver = $driver;

        return $this;
    }

    public function getCar(): ?Car
    {
        return $this->car;
    }

    public function setCar(?Car $car): self
    {
        $this->car = $car;

        return $this;
    }

    public function __toString()
    {
        return 'Date de début: ' . $this->beginAt->format('d/m/Y') . '- Date de fin: ' . $this->endAt->format('Y-m-d'). '- Conducteur: ' . $this->driver . '- Véhicule: ' . $this->car;
    }
}
