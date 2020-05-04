<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PremiersSecoursRepository")
 */
class PremiersSecours
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $inhatation;

    /**
     * @ORM\Column(type="text")
     */
    private $yeux;

    /**
     * @ORM\Column(type="text")
     */
    private $peau;

    /**
     * @ORM\Column(type="text")
     */
    private $ingestion;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $symptomes;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $soins;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInhalation(): ?string
    {
        return $this->inhatation;
    }

    public function setInhalation(string $inhatation): self
    {
        $this->inhatation = $inhatation;

        return $this;
    }

    public function getYeux(): ?string
    {
        return $this->yeux;
    }

    public function setYeux(string $yeux): self
    {
        $this->yeux = $yeux;

        return $this;
    }

    public function getPeau(): ?string
    {
        return $this->peau;
    }

    public function setPeau(string $peau): self
    {
        $this->peau = $peau;

        return $this;
    }

    public function getIngestion(): ?string
    {
        return $this->ingestion;
    }

    public function setIngestion(string $ingestion): self
    {
        $this->ingestion = $ingestion;

        return $this;
    }

    public function getSymptomes(): ?string
    {
        return $this->symptomes;
    }

    public function setSymptomes(?string $symptomes): self
    {
        $this->symptomes = $symptomes;

        return $this;
    }

    public function getSoins(): ?string
    {
        return $this->soins;
    }

    public function setSoins(?string $soins): self
    {
        $this->soins = $soins;

        return $this;
    }

    public function getInhatation(): ?string
    {
        return $this->inhatation;
    }

    public function setInhatation(string $inhatation): self
    {
        $this->inhatation = $inhatation;

        return $this;
    }
}
