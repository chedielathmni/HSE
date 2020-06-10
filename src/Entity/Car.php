<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CarRepository")
 */
class Car
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $number;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $model;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\GasPurchase", mappedBy="car")
     */
    private $gasPurchases;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $carteGrise;

    /**
     * @ORM\Column(type="boolean")
     */
    private $airbag;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $oilDate;

    /**
     * @ORM\Column(type="integer")
     */
    private $kilometrage;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $frWheelChangeDate;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $flWheelChangeDate;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $brWheelChangeDate;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $blWheelChangeDate;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $frontBrakesChangeDate;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $backBrakesChangeDate;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $lastInspectionDate;

    /**
     * @ORM\OneToMany(targetEntity=History::class, mappedBy="car")
     */
    private $history;



    public function __construct()
    {
        $this->gasPurchases = new ArrayCollection();
        $this->history = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }


    public function __toString()
    {
        return $this->number;
    }

    /**
     * @return Collection|GasPurchase[]
     */
    public function getGasPurchases(): Collection
    {
        return $this->gasPurchases;
    }

    public function addGasPurchase(GasPurchase $gasPurchase): self
    {
        if (!$this->gasPurchases->contains($gasPurchase)) {
            $this->gasPurchases[] = $gasPurchase;
            $gasPurchase->setCar($this);
        }

        return $this;
    }

    public function removeGasPurchase(GasPurchase $gasPurchase): self
    {
        if ($this->gasPurchases->contains($gasPurchase)) {
            $this->gasPurchases->removeElement($gasPurchase);
            // set the owning side to null (unless already changed)
            if ($gasPurchase->getCar() === $this) {
                $gasPurchase->setCar(null);
            }
        }

        return $this;
    }

    public function getCarteGrise(): ?string
    {
        return $this->carteGrise;
    }

    public function setCarteGrise(string $carteGrise): self
    {
        $this->carteGrise = $carteGrise;

        return $this;
    }

    public function getAirbag(): ?bool
    {
        return $this->airbag;
    }

    public function setAirbag(bool $airbag): self
    {
        $this->airbag = $airbag;

        return $this;
    }

    public function getOilDate(): ?\DateTimeInterface
    {
        return $this->oilDate;
    }

    public function setOilDate(?\DateTimeInterface $oilDate): self
    {
        $this->oilDate = $oilDate;

        return $this;
    }

    public function getKilometrage(): ?int
    {
        return $this->kilometrage;
    }

    public function setKilometrage(int $kilometrage): self
    {
        $this->kilometrage = $kilometrage;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getFrWheelChangeDate(): ?\DateTimeInterface
    {
        return $this->frWheelChangeDate;
    }

    public function setFrWheelChangeDate(?\DateTimeInterface $frWheelChangeDate): self
    {
        $this->frWheelChangeDate = $frWheelChangeDate;

        return $this;
    }

    public function getFlWheelChangeDate(): ?\DateTimeInterface
    {
        return $this->flWheelChangeDate;
    }

    public function setFlWheelChangeDate(?\DateTimeInterface $flWheelChangeDate): self
    {
        $this->flWheelChangeDate = $flWheelChangeDate;

        return $this;
    }

    public function getBrWheelChangeDate(): ?\DateTimeInterface
    {
        return $this->brWheelChangeDate;
    }

    public function setBrWheelChangeDate(?\DateTimeInterface $brWheelChangeDate): self
    {
        $this->brWheelChangeDate = $brWheelChangeDate;

        return $this;
    }

    public function getBlWheelChangeDate(): ?\DateTimeInterface
    {
        return $this->blWheelChangeDate;
    }

    public function setBlWheelChangeDate(?\DateTimeInterface $blWheelChangeDate): self
    {
        $this->blWheelChangeDate = $blWheelChangeDate;

        return $this;
    }

    public function getFrontBrakesChangeDate(): ?\DateTimeInterface
    {
        return $this->frontBrakesChangeDate;
    }

    public function setFrontBrakesChangeDate(?\DateTimeInterface $frontBrakesChangeDate): self
    {
        $this->frontBrakesChangeDate = $frontBrakesChangeDate;

        return $this;
    }

    public function getBackBrakesChangeDate(): ?\DateTimeInterface
    {
        return $this->backBrakesChangeDate;
    }

    public function setBackBrakesChangeDate(?\DateTimeInterface $backBrakesChangeDate): self
    {
        $this->backBrakesChangeDate = $backBrakesChangeDate;

        return $this;
    }

    public function getLastInspectionDate(): ?\DateTimeInterface
    {
        return $this->lastInspectionDate;
    }

    public function setLastInspectionDate(?\DateTimeInterface $lastInspectionDate): self
    {
        $this->lastInspectionDate = $lastInspectionDate;

        return $this;
    }

    /**
     * @return Collection|History[]
     */
    public function getHistory(): Collection
    {
        return $this->history;
    }

    public function addHistory(History $history): self
    {
        if (!$this->history->contains($history)) {
            $this->history[] = $history;
            $history->setCar($this);
        }

        return $this;
    }

    public function removeHistory(History $history): self
    {
        if ($this->history->contains($history)) {
            $this->history->removeElement($history);
            // set the owning side to null (unless already changed)
            if ($history->getCar() === $this) {
                $history->setCar(null);
            }
        }

        return $this;
    }
}
