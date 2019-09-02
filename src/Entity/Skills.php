<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Skills
 *
 * @ORM\Table(name="skills", indexes={@ORM\Index(name="id_order", columns={"id_order"}), @ORM\Index(name="id_type_skill", columns={"id_type_skill"}), @ORM\Index(name="id_label", columns={"id_label"})})
 * @ORM\Entity
 */
class Skills
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_skill", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idSkill;

    /**
     * @var float
     *
     * @ORM\Column(name="star", type="float", precision=10, scale=0, nullable=false)
     */
    private $star;

    /**
     * @var string
     *
     * @ORM\Column(name="year_acquisition", type="string", length=45, nullable=false)
     */
    private $yearAcquisition;

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
     * @var bool|null
     *
     * @ORM\Column(name="active", type="boolean", nullable=true)
     */
    private $active = '0';

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
     * @var \TypeSkills
     *
     * @ORM\ManyToOne(targetEntity="TypeSkills")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_type_skill", referencedColumnName="id_type_skill")
     * })
     */
    private $idTypeSkill;

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
     * @ORM\ManyToMany(targetEntity="Cv", mappedBy="idSkill")
     */
    private $idCv;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idCv = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdSkill(): ?int
    {
        return $this->idSkill;
    }

    public function getStar(): ?float
    {
        return $this->star;
    }

    public function setStar(float $star): self
    {
        $this->star = $star;

        return $this;
    }

    public function getYearAcquisition(): ?string
    {
        return $this->yearAcquisition;
    }

    public function setYearAcquisition(string $yearAcquisition): self
    {
        $this->yearAcquisition = $yearAcquisition;

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

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(?bool $active): self
    {
        $this->active = $active;

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

    public function getIdTypeSkill(): ?TypeSkills
    {
        return $this->idTypeSkill;
    }

    public function setIdTypeSkill(?TypeSkills $idTypeSkill): self
    {
        $this->idTypeSkill = $idTypeSkill;

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
     * @return Collection|Cv[]
     */
    public function getIdCv(): Collection
    {
        return $this->idCv;
    }

    public function addIdCv(Cv $idCv): self
    {
        if (!$this->idCv->contains($idCv)) {
            $this->idCv[] = $idCv;
            $idCv->addIdSkill($this);
        }

        return $this;
    }

    public function removeIdCv(Cv $idCv): self
    {
        if ($this->idCv->contains($idCv)) {
            $this->idCv->removeElement($idCv);
            $idCv->removeIdSkill($this);
        }

        return $this;
    }

}
