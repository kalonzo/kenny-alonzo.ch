<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Widget
 *
 * @ORM\Table(name="widget", indexes={@ORM\Index(name="id_category", columns={"id_category"})})
 * @ORM\Entity
 */
class Widget
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_widget", type="binary", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idWidget;

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
     * @var \Categories
     *
     * @ORM\ManyToOne(targetEntity="Categories")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_category", referencedColumnName="id_category")
     * })
     */
    private $idCategory;

    public function getIdWidget(): ?int
    {
        return $this->idWidget;
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

    public function getIdCategory(): ?Categories
    {
        return $this->idCategory;
    }

    public function setIdCategory(?Categories $idCategory): self
    {
        $this->idCategory = $idCategory;

        return $this;
    }


}
