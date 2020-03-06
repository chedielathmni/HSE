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
}



/*

We have : 
    - Product Name
    - Conseil de Prudence
    - Mention de danger

We Need to add:

    ---- Identification ----
    
    - Code Produit : string - required 
    - Fournisseur : Entity - required ManyToOne
    - Numero Urgence : string - required

    ---- Dangers ----
    - Pictogrammes : string 
    - Identificateur Produit : string required
    - Fiche de données de sécurité : fichier 



/*