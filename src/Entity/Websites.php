<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Websites
 *
 * @ORM\Table(name="websites", indexes={@ORM\Index(name="id_label", columns={"id_label"})})
 * @ORM\Entity
 */
class Websites
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_web", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idWeb;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=45, nullable=false)
     */
    private $slug;

    /**
     * @var string|null
     *
     * @ORM\Column(name="descn", type="blob", length=65535, nullable=true)
     */
    private $descn;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creation_date", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $creationDate = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="published_at", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $publishedAt = 'CURRENT_TIMESTAMP';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="active", type="boolean", nullable=true)
     */
    private $active = '0';

    /**
     * @var \Labels
     *
     * @ORM\ManyToOne(targetEntity="Labels")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_label", referencedColumnName="id_label")
     * })
     */
    private $idLabel;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Portfolios", mappedBy="idWeb")
     */
    private $idPortfolio;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idPortfolio = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdWeb(): ?int
    {
        return $this->idWeb;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getDescn()
    {
        return $this->descn;
    }

    public function setDescn($descn): self
    {
        $this->descn = $descn;

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

    public function getPublishedAt(): ?\DateTimeInterface
    {
        return $this->publishedAt;
    }

    public function setPublishedAt(\DateTimeInterface $publishedAt): self
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(?bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getIdLabel(): ?Labels
    {
        return $this->idLabel;
    }

    public function setIdLabel(?Labels $idLabel): self
    {
        $this->idLabel = $idLabel;

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
            $idPortfolio->addIdWeb($this);
        }

        return $this;
    }

    public function removeIdPortfolio(Portfolios $idPortfolio): self
    {
        if ($this->idPortfolio->contains($idPortfolio)) {
            $this->idPortfolio->removeElement($idPortfolio);
            $idPortfolio->removeIdWeb($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getName();
    }

}
