<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TransporterRepository")
 */
class Transporter
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"read:tr"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank
     * @Groups({"read:tr"})
     */
    private $phoneNumber;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Groups({"read:tr"})
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Groups({"read:tr"})
     */
    private $lastName;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\GasPurchase", mappedBy="driver")
     * @Groups({"read:tr"})
     */
    private $gasPurchases;


    private $apiKey;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Car", cascade={"persist", "remove"})
     */
    private $car;

    /**
     * @ORM\Column(type="boolean", nullable = true)
     */
    private $valid;

    /**
     * @ORM\OneToMany(targetEntity=History::class, mappedBy="driver")
     */
    private $history;


    public function getApiKey() : string {
        return $this->apiKey;
    }

    public function setApiKey(string $apiKey) : ?self {
        $this->apiKey = $apiKey;
        return $this;
    }


    public function __construct()
    {
        $this->gasPurchases = new ArrayCollection();
        $this->history = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }


    public function __toString()
    {
        return $this->firstName . ' ' . $this->lastName;
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
            $gasPurchase->setDriver($this);
        }

        return $this;
    }

    public function removeGasPurchase(GasPurchase $gasPurchase): self
    {
        if ($this->gasPurchases->contains($gasPurchase)) {
            $this->gasPurchases->removeElement($gasPurchase);
            // set the owning side to null (unless already changed)
            if ($gasPurchase->getDriver() === $this) {
                $gasPurchase->setDriver(null);
            }
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * @param $salt
     * @return Account
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

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

    public function getValid(): ?bool
    {
        return $this->valid;
    }

    public function setValid(bool $valid): self
    {
        $this->valid = $valid;

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
            $history->setDriver($this);
        }

        return $this;
    }

    public function removeHistory(History $history): self
    {
        if ($this->history->contains($history)) {
            $this->history->removeElement($history);
            // set the owning side to null (unless already changed)
            if ($history->getDriver() === $this) {
                $history->setDriver(null);
            }
        }

        return $this;
    }

}
