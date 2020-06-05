<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GasPurchaseRepository")
 * @ApiResource(
 *     collectionOperations={"get", "post"},
 *     itemOperations={"get"},
 *     
 * )
 */
class GasPurchase
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"read:gas"})
     * @Groups({"read:tr"})
     */
    private $id;


    /**
     * @ORM\Column(type="datetime")
     * @Groups({"read:gas"})
     * @Groups({"read:tr"})
     */
    private $purchaseDate;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"read:gas"})
     * @Groups({"read:tr"})
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:gas"})
     * @Groups({"read:tr"})
     */
    private $gasType;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Transporter", inversedBy="gasPurchases")
     * @ORM\JoinColumn(nullable=false)
     */
    private $driver;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Car", inversedBy="gasPurchases")
     */
    private $car;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $utility;

    public function getId(): ?int
    {
        return $this->id;
    }



    public function getPurchaseDate(): ?\DateTimeInterface
    {
        return $this->purchaseDate;
    }

    public function setPurchaseDate(\DateTimeInterface $purchaseDate): self
    {
        $this->purchaseDate = $purchaseDate;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getGasType(): ?string
    {
        return $this->gasType;
    }

    public function setGasType(string $gasType): self
    {
        $this->gasType = $gasType;

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

    public function getUtility(): ?string
    {
        return $this->utility;
    }

    public function setUtility(?string $utility): self
    {
        $this->utility = $utility;

        return $this;
    }
}
