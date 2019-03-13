<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Subcategories
 *
 * @ORM\Table(name="subcategories", indexes={@ORM\Index(name="id_type", columns={"id_type"}), @ORM\Index(name="id_order", columns={"id_order"}), @ORM\Index(name="id_label", columns={"id_label"})})
 * @ORM\Entity
 */
class Subcategories
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_subcategory", type="binary", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idSubcategory;

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
     * @var \DateTime|null
     *
     * @ORM\Column(name="published_at", type="datetime", nullable=true)
     */
    private $publishedAt;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="active", type="boolean", nullable=true)
     */
    private $active = '0';

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
     * @var \Orders
     *
     * @ORM\ManyToOne(targetEntity="Orders")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_order", referencedColumnName="id_order")
     * })
     */
    private $idOrder;

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
     * @ORM\ManyToMany(targetEntity="Categories", mappedBy="idSubcategory")
     */
    private $idCategory;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idCategory = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdSubcategory(): ?int
    {
        return $this->idSubcategory;
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

    public function setPublishedAt(?\DateTimeInterface $publishedAt): self
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

    public function getIdType(): ?Types
    {
        return $this->idType;
    }

    public function setIdType(?Types $idType): self
    {
        $this->idType = $idType;

        return $this;
    }

    public function getIdOrder(): ?Orders
    {
        return $this->idOrder;
    }

    public function setIdOrder(?Orders $idOrder): self
    {
        $this->idOrder = $idOrder;

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
     * @return Collection|Categories[]
     */
    public function getIdCategory(): Collection
    {
        return $this->idCategory;
    }

    public function addIdCategory(Categories $idCategory): self
    {
        if (!$this->idCategory->contains($idCategory)) {
            $this->idCategory[] = $idCategory;
            $idCategory->addIdSubcategory($this);
        }

        return $this;
    }

    public function removeIdCategory(Categories $idCategory): self
    {
        if ($this->idCategory->contains($idCategory)) {
            $this->idCategory->removeElement($idCategory);
            $idCategory->removeIdSubcategory($this);
        }

        return $this;
    }

}
