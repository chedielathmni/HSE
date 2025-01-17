<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 * @Vich\Uploadable
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Fournisseur", inversedBy="products", cascade={"persist", "remove"})
     */
    private $fournisseur;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Adresse", cascade={"persist"})
     */
    private $adresseFournisseur;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Pictogramme")
     */
    private $pictogramme;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\PremiersSecours", cascade={"persist", "remove"})
     */
    private $premiersSecours;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Protection")
     */
    private $protection;



    /**
     * @Vich\UploadableField(mapping="fiches", fileNameProperty="fiche")
     * @var File
     */
    private $ficheFile;

    /**
     * @ORM\Column(type="datetime", nullable = true)
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fiche;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Fournisseur", cascade={"persist"})
     */
    private $newFournisseur;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Entry", mappedBy="product", orphanRemoval=true)
     */
    private $entries;

    /**
     * @ORM\Column(type="integer")
     */
    private $dureeConservation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $dechet;

    /**
     * @ORM\ManyToMany(targetEntity=WorkingZone::class, mappedBy="products")
     */
    private $workingZones;

    public function __construct()
    {
        $this->conseil = new ArrayCollection();
        $this->mentionDangers = new ArrayCollection();
        $this->pictogramme = new ArrayCollection();
        $this->protection = new ArrayCollection();
        $this->updatedAt = new \DateTime('now');

        $this->newFournisseur ? $this->fournisseur = $this->newFournisseur: null ;
        $this->entries = new ArrayCollection();
        $this->workingZones = new ArrayCollection();
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

    /**
     * @return Collection|Pictogramme[]
     */
    public function getPictogramme(): Collection
    {
        return $this->pictogramme;
    }

    public function addPictogramme(Pictogramme $pictogramme): self
    {
        if (!$this->pictogramme->contains($pictogramme)) {
            $this->pictogramme[] = $pictogramme;
        }

        return $this;
    }

    public function removePictogramme(Pictogramme $pictogramme): self
    {
        if ($this->pictogramme->contains($pictogramme)) {
            $this->pictogramme->removeElement($pictogramme);
        }

        return $this;
    }

    public function getPremiersSecours(): ?PremiersSecours
    {
        return $this->premiersSecours;
    }

    public function setPremiersSecours(?PremiersSecours $premiersSecours): self
    {
        $this->premiersSecours = $premiersSecours;

        return $this;
    }

    /**
     * @return Collection|Protection[]
     */
    public function getProtection(): Collection
    {
        return $this->protection;
    }

    public function addProtection(Protection $protection): self
    {
        if (!$this->protection->contains($protection)) {
            $this->protection[] = $protection;
        }

        return $this;
    }

    public function removeProtection(Protection $protection): self
    {
        if ($this->protection->contains($protection)) {
            $this->protection->removeElement($protection);
        }

        return $this;
    }

    public function setFiche($fiche)
    {
        $this->fiche = $fiche;
    }

    public function getFiche()
    {
        return $this->fiche;
    }


    public function getFicheFile()
    {
        return $this->ficheFile;
    }


    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|UploadedFile|null $ficheFile
     */
    public function setFicheFile(File $fiche = null)
    {
        $this->ficheFile = $fiche;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($fiche) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
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

    public function removeAssociations():self
    {
        foreach($this->getConseil() as $c) $this->removeConseil($c);
        foreach($this->getPictogramme() as $p) $this->removePictogramme($p);
        foreach($this->getMentionDangers() as $d) $this->removeMentionDanger($d);
        foreach($this->getProtection() as $p) $this->removeProtection($p);
        $this->fournisseur = null;

        return $this;
    }

    public function __toString()
    {
        return $this->productName . '-' . $this->productCode;
    }

    public function getNewFournisseur(): ?Fournisseur
    {
        return $this->newFournisseur;
    }

    public function setNewFournisseur(?Fournisseur $newFournisseur): self
    {
        $this->newFournisseur = $newFournisseur;

        return $this;
    }

    /**
     * @return Collection|Entry[]
     */
    public function getEntries(): Collection
    {
        return $this->entries;
    }

    public function addEntry(Entry $entry): self
    {
        if (!$this->entries->contains($entry)) {
            $this->entries[] = $entry;
            $entry->setProduct($this);
        }

        return $this;
    }

    public function removeEntry(Entry $entry): self
    {
        if ($this->entries->contains($entry)) {
            $this->entries->removeElement($entry);
            // set the owning side to null (unless already changed)
            if ($entry->getProduct() === $this) {
                $entry->setProduct(null);
            }
        }

        return $this;
    }

    public function getDureeConservation(): ?int
    {
        return $this->dureeConservation;
    }

    public function setDureeConservation(int $dureeConservation): self
    {
        $this->dureeConservation = $dureeConservation;

        return $this;
    }

    public function getDechet(): ?string
    {
        return $this->dechet;
    }

    public function setDechet(string $dechet): self
    {
        $this->dechet = $dechet;

        return $this;
    }

    /**
     * @return Collection|WorkingZone[]
     */
    public function getWorkingZones(): Collection
    {
        return $this->workingZones;
    }

    public function addWorkingZone(WorkingZone $workingZone): self
    {
        if (!$this->workingZones->contains($workingZone)) {
            $this->workingZones[] = $workingZone;
            $workingZone->addProduct($this);
        }

        return $this;
    }

    public function removeWorkingZone(WorkingZone $workingZone): self
    {
        if ($this->workingZones->contains($workingZone)) {
            $this->workingZones->removeElement($workingZone);
            $workingZone->removeProduct($this);
        }

        return $this;
    }
}

