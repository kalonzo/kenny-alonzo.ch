<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Categories
 *
 * @ORM\Table(name="categories", indexes={@ORM\Index(name="id_type", columns={"id_type"}), @ORM\Index(name="id_order", columns={"id_order"}), @ORM\Index(name="id_label", columns={"id_label"})})
 * @ORM\Entity
 */
class Categories
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_category", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCategory;

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
     * @ORM\ManyToMany(targetEntity="Subcategories", inversedBy="idCategory")
     * @ORM\JoinTable(name="categories_sub_categories",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_category", referencedColumnName="id_category")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_subcategory", referencedColumnName="id_subcategory")
     *   }
     * )
     */
    private $idSubcategory;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Menus", mappedBy="idCategory")
     */
    private $idMenu;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idSubcategory = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idMenu = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdCategory(): ?int
    {
        return $this->idCategory;
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
     * @return Collection|Subcategories[]
     */
    public function getIdSubcategory(): Collection
    {
        return $this->idSubcategory;
    }

    public function addIdSubcategory(Subcategories $idSubcategory): self
    {
        if (!$this->idSubcategory->contains($idSubcategory)) {
            $this->idSubcategory[] = $idSubcategory;
        }

        return $this;
    }

    public function removeIdSubcategory(Subcategories $idSubcategory): self
    {
        if ($this->idSubcategory->contains($idSubcategory)) {
            $this->idSubcategory->removeElement($idSubcategory);
        }

        return $this;
    }

    /**
     * @return Collection|Menus[]
     */
    public function getIdMenu(): Collection
    {
        return $this->idMenu;
    }

    public function addIdMenu(Menus $idMenu): self
    {
        if (!$this->idMenu->contains($idMenu)) {
            $this->idMenu[] = $idMenu;
            $idMenu->addIdCategory($this);
        }

        return $this;
    }

    public function removeIdMenu(Menus $idMenu): self
    {
        if ($this->idMenu->contains($idMenu)) {
            $this->idMenu->removeElement($idMenu);
            $idMenu->removeIdCategory($this);
        }

        return $this;
    }

}
