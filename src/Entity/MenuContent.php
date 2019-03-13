<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * MenuContent
 *
 * @ORM\Table(name="menu_content")
 * @ORM\Entity
 */
class MenuContent
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_menu_content", type="binary", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idMenuContent;

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
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Menus", inversedBy="idMenuContent")
     * @ORM\JoinTable(name="menu_content_menus",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_menu_content", referencedColumnName="id_menu_content")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_menu", referencedColumnName="id_menu")
     *   }
     * )
     */
    private $idMenu;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idMenu = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdMenuContent(): ?int
    {
        return $this->idMenuContent;
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
        }

        return $this;
    }

    public function removeIdMenu(Menus $idMenu): self
    {
        if ($this->idMenu->contains($idMenu)) {
            $this->idMenu->removeElement($idMenu);
        }

        return $this;
    }

}
