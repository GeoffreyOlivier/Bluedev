<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PhotosRepository")
 * @Vich\Uploadable
 */
class Photos
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
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="photo_image", fileNameProperty="image")
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categorie", inversedBy ="Photos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SousCat", inversedBy ="photos")
     */
    private $sousCat;

    public function __construct()
    {
        $this->sousCat = new ArrayCollection();
    }





//    public function setImageFile(File $image = null)
//    {
//        $this->imageFile = $image;
//
//        // VERY IMPORTANT:
//        // It is required that at least one field changes if you are using Doctrine,
//        // otherwise the event listeners won't be called and the file is lost
//        if ($image) {
//            // if 'updatedAt' is not defined in your entity, use another property
//            $this->updatedAt = new \DateTime('now');
//        }
//    }

    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

    }
    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection|sousCat[]
     */
    public function getSousCat(): Collection
    {
        return $this->sousCat;
    }

    public function addSousCat(sousCat $sousCat): self
    {
        if (!$this->sousCat->contains($sousCat)) {
            $this->sousCat[] = $sousCat;
            $sousCat->setPhotos($this);
        }

        return $this;
    }

    public function removeSousCat(sousCat $sousCat): self
    {
        if ($this->sousCat->contains($sousCat)) {
            $this->sousCat->removeElement($sousCat);
            // set the owning side to null (unless already changed)
            if ($sousCat->getPhotos() === $this) {
                $sousCat->setPhotos(null);
            }
        }

        return $this;
    }



}
