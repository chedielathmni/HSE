<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
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
    private $productName;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ConseilPrudence", mappedBy="product")
     */
    private $conseil;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MentionDanger", mappedBy="product")
     */
    private $mentionDangers;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $productCode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numeroUrgence;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Fournisseur", inversedBy="products", cascade={"persist"})
     */
    private $fournisseur;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Adresse", cascade={"persist", "remove"})
     */
    private $adresseFournisseur;

    public function __construct()
    {
        $this->conseil = new ArrayCollection();
        $this->mentionDangers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductName(): ?string
    {
        return $this->productName;
    }

    public function setProductName(string $productName): self
    {
        $this->productName = $productName;

        return $this;
    }

    /**
     * @return Collection|ConseilPrudence[]
     */
    public function getConseil(): Collection
    {
        return $this->conseil;
    }

    public function addConseil(ConseilPrudence $conseil): self
    {
        if (!$this->conseil->contains($conseil)) {
            $this->conseil[] = $conseil;
            $conseil->setProduct($this);
        }

        return $this;
    }

    public function removeConseil(ConseilPrudence $conseil): self
    {
        if ($this->conseil->contains($conseil)) {
            $this->conseil->removeElement($conseil);
            // set the owning side to null (unless already changed)
            if ($conseil->getProduct() === $this) {
                $conseil->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|MentionDanger[]
     */
    public function getMentionDangers(): Collection
    {
        return $this->mentionDangers;
    }

    public function addMentionDanger(MentionDanger $mentionDanger): self
    {
        if (!$this->mentionDangers->contains($mentionDanger)) {
            $this->mentionDangers[] = $mentionDanger;
            $mentionDanger->setProduct($this);
        }

        return $this;
    }

    public function removeMentionDanger(MentionDanger $mentionDanger): self
    {
        if ($this->mentionDangers->contains($mentionDanger)) {
            $this->mentionDangers->removeElement($mentionDanger);
            // set the owning side to null (unless already changed)
            if ($mentionDanger->getProduct() === $this) {
                $mentionDanger->setProduct(null);
            }
        }

        return $this;
    }

    public function getProductCode(): ?string
    {
        return $this->productCode;
    }

    public function setProductCode(string $productCode): self
    {
        $this->productCode = $productCode;

        return $this;
    }

    public function getNumeroUrgence(): ?string
    {
        return $this->numeroUrgence;
    }

    public function setNumeroUrgence(string $numeroUrgence): self
    {
        $this->numeroUrgence = $numeroUrgence;

        return $this;
    }

    public function getFournisseur(): ?Fournisseur
    {
        return $this->fournisseur;
    }

    public function setFournisseur(?Fournisseur $fournisseur): self
    {
        $this->fournisseur = $fournisseur;

        return $this;
    }

    public function getAdresseFournisseur(): ?Adresse
    {
        return $this->adresseFournisseur;
    }

    public function setAdresseFournisseur(?Adresse $adresseFournisseur): self
    {
        $this->adresseFournisseur = $adresseFournisseur;

        return $this;
    }
}

