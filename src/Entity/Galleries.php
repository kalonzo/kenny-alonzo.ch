<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
//imporatation de la class Utils contenant principalement du code non gémérer par l'application

/**
 * Galleries
 *
 * @ORM\Table(name="galleries", indexes={@ORM\Index(name="id_type", columns={"id_type"})})
 * @ORM\Entity
 */
class Galleries
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_gallery", type="id", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * 
     */
    private $idGallery;

    /**
     * @var string
     *
     * @ORM\Column(name="fileName", type="string", length=100, nullable=false)
     * @Assert\Image(
     *     minWidth = 200,
     *     maxWidth = 400,
     *     minHeight = 200,
     *     maxHeight = 400
     * )
     */
    private $filename;

    /**
     * @var string
     *
     * @ORM\Column(name="uniqueFileName", type="string", length=100, nullable=false)
     */
    private $uniquefilename;

    /**
     * @var string|null
     *
     * @ORM\Column(name="image", type="blob", length=65535, nullable=true)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="duration", type="string", length=45, nullable=false)
     */
    private $duration = "Default 0";

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creation_date", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $creationDate;

    /**
     * @var \Types
     *
     * @ORM\ManyToOne(targetEntity="Types")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_type", referencedColumnName="id_type")
     * })
     */
    private $idType;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Portfolios", mappedBy="idGallery")
     */
    private $idPortfolio;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idPortfolio = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdGallery()
    {
        return $this->idGallery;
    }

    public function setIdGallery($id): self
    {
        $this->idGallery = $id;

        return $this;
    }

    public function getFilename()
    {
        return $this->filename;
    }

    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    public function getUniquefilename(): ?string
    {
        return $this->uniquefilename;
    }

    public function setUniquefilename(string $uniquefilename): self
    {
        $this->uniquefilename = $uniquefilename;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getDuration(): ?string
    {
        return $this->duration;
    }

    public function setDuration(string $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTimeInterface $creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    public function getIdType(): ?Types
    {
        return $this->idType;
    }

    public function setIdType($idType)
    {
        $this->idType = $idType;

        return $this;
    }

    /**
     * @return Collection|Portfolios[]
     */
    public function getIdPortfolio(): Collection
    {
        return $this->idPortfolio;
    }

    public function addIdPortfolio(Portfolios $idPortfolio): self
    {
        if (!$this->idPortfolio->contains($idPortfolio)) {
            $this->idPortfolio[] = $idPortfolio;
            $idPortfolio->addIdGallery($this);
        }

        return $this;
    }

    public function removeIdPortfolio(Portfolios $idPortfolio): self
    {
        if ($this->idPortfolio->contains($idPortfolio)) {
            $this->idPortfolio->removeElement($idPortfolio);
            $idPortfolio->removeIdGallery($this);
        }

        return $this;
    }

    public function __toString()
    {
    return $this->getUniquefilename();
    }

}
