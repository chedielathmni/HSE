<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GasPurchaseRepository")
 * @ApiResource(
    normalizationContext={"groups"={"read:gas"}},
    collectionOperations={"get","post"},
    itemOperations={"get"})
 */
class GasPurchase
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"read:gas"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="gasPurchases")
     * @ORM\JoinColumn(nullable=false)
     */
    private $driver;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:gas"})
     */
    private $carNumber;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"read:gas"})
     */
    private $purchaseDate;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"read:gas"})
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:gas"})
     */
    private $gasType;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDriver(): ?User
    {
        return $this->driver;
    }

    public function setDriver(?User $driver): self
    {
        $this->driver = $driver;

        return $this;
    }

    public function getCarNumber(): ?string
    {
        return $this->carNumber;
    }

    public function setCarNumber(string $carNumber): self
    {
        $this->carNumber = $carNumber;

        return $this;
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
}
