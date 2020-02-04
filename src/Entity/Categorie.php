<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategorieRepository")
 */
class Categorie
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
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Photos", mappedBy="categorie")
     */
    private $Photos;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SousCat", inversedBy="categorie")
     */
    private $sousCat;

    
    public function __construct()
    {
        $this->Photos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Photos[]
     */
    public function getPhotos(): Collection
    {
        return $this->Photos;
    }

    public function addPhotos(Photos $Photos): self
    {
        if (!$this->Photos->contains($Photos)) {
            $this->Photos[] = $Photos;
            $Photos->setCategorie($this);
        }

        return $this;
    }

    public function removePhotos(Photos $Photos): self
    {
        if ($this->Photos->contains($Photos)) {
            $this->Photos->removeElement($Photos);
            // set the owning side to null (unless already changed)
            if ($Photos->getCategorie() === $this) {
                $Photos->setCategorie(null);
            }
        }

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function __toString()
    {
        return $this->libelle;
    }

    public function getSousCat(): ?SousCat
    {
        return $this->sousCat;
    }

    public function setSousCat(?SousCat $sousCat): self
    {
        $this->sousCat = $sousCat;

        return $this;
    }

}
