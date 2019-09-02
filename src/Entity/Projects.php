<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Projects
 *
 * @ORM\Table(name="projects", indexes={@ORM\Index(name="id_business_name", columns={"id_business_name"})})
 * @ORM\Entity
 */
class Projects
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_project", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idProject;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="scope", type="string", length=45, nullable=true, options={"default"="General"})
     */
    private $scope = 'General';

    /**
     * @var string
     *
     * @ORM\Column(name="quality", type="string", length=45, nullable=false)
     */
    private $quality;

    /**
     * @var string
     *
     * @ORM\Column(name="cost", type="string", length=45, nullable=false)
     */
    private $cost;

    /**
     * @var string
     *
     * @ORM\Column(name="budget", type="string", length=45, nullable=false)
     */
    private $budget;

    /**
     * @var string
     *
     * @ORM\Column(name="benefit", type="string", length=45, nullable=false)
     */
    private $benefit;

    /**
     * @var string
     *
     * @ORM\Column(name="risk", type="string", length=45, nullable=false)
     */
    private $risk;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_date", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $startDate = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_date", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $endDate = 'CURRENT_TIMESTAMP';

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
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=45, nullable=false)
     */
    private $slug;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="active", type="boolean", nullable=true)
     */
    private $active = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="valuenow", type="integer", nullable=true)
     */
    private $valuenow = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="valuemin", type="integer", nullable=true)
     */
    private $valuemin = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="valuemax", type="integer", nullable=true, options={"default"="100"})
     */
    private $valuemax = '100';

    /**
     * @var string|null
     *
     * @ORM\Column(name="style", type="string", length=45, nullable=true, options={"default"="info"})
     */
    private $style = 'info';

    /**
     * @var \BusinessName
     *
     * @ORM\ManyToOne(targetEntity="BusinessName")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_business_name", referencedColumnName="id_business_name")
     * })
     */
    private $idBusinessName;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Portfolios", mappedBy="idProject")
     */
    private $idPortfolio;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idPortfolio = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdProject(): ?int
    {
        return $this->idProject;
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

    public function getScope(): ?string
    {
        return $this->scope;
    }

    public function setScope(?string $scope): self
    {
        $this->scope = $scope;

        return $this;
    }

    public function getQuality(): ?string
    {
        return $this->quality;
    }

    public function setQuality(string $quality): self
    {
        $this->quality = $quality;

        return $this;
    }

    public function getCost(): ?string
    {
        return $this->cost;
    }

    public function setCost(string $cost): self
    {
        $this->cost = $cost;

        return $this;
    }

    public function getBudget(): ?string
    {
        return $this->budget;
    }

    public function setBudget(string $budget): self
    {
        $this->budget = $budget;

        return $this;
    }

    public function getBenefit(): ?string
    {
        return $this->benefit;
    }

    public function setBenefit(string $benefit): self
    {
        $this->benefit = $benefit;

        return $this;
    }

    public function getRisk(): ?string
    {
        return $this->risk;
    }

    public function setRisk(string $risk): self
    {
        $this->risk = $risk;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

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

    public function getValuenow(): ?int
    {
        return $this->valuenow;
    }

    public function setValuenow(?int $valuenow): self
    {
        $this->valuenow = $valuenow;

        return $this;
    }

    public function getValuemin(): ?int
    {
        return $this->valuemin;
    }

    public function setValuemin(?int $valuemin): self
    {
        $this->valuemin = $valuemin;

        return $this;
    }

    public function getValuemax(): ?int
    {
        return $this->valuemax;
    }

    public function setValuemax(?int $valuemax): self
    {
        $this->valuemax = $valuemax;

        return $this;
    }

    public function getStyle(): ?string
    {
        return $this->style;
    }

    public function setStyle(?string $style): self
    {
        $this->style = $style;

        return $this;
    }

    public function getIdBusinessName(): ?BusinessName
    {
        return $this->idBusinessName;
    }

    public function setIdBusinessName(?BusinessName $idBusinessName): self
    {
        $this->idBusinessName = $idBusinessName;

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
            $idPortfolio->addIdProject($this);
        }

        return $this;
    }

    public function removeIdPortfolio(Portfolios $idPortfolio): self
    {
        if ($this->idPortfolio->contains($idPortfolio)) {
            $this->idPortfolio->removeElement($idPortfolio);
            $idPortfolio->removeIdProject($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getName();
    }

}
