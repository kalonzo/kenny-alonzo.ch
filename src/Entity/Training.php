<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Training
 *
 * @ORM\Table(name="training", indexes={@ORM\Index(name="id_order", columns={"id_order"}), @ORM\Index(name="id_label", columns={"id_label"}), @ORM\Index(name="id_business_name", columns={"id_business_name"})})
 * @ORM\Entity
 */
class Training
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_training", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTraining;

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
     * @ORM\Column(name="context", type="blob", length=65535, nullable=true)
     */
    private $context;

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
     * @var \Labels
     *
     * @ORM\ManyToOne(targetEntity="Labels")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_label", referencedColumnName="id_label")
     * })
     */
    private $idLabel;

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
     * @ORM\ManyToMany(targetEntity="Cv", mappedBy="idTraining")
     */
    private $idCv;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idCv = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdTraining(): ?int
    {
        return $this->idTraining;
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

    public function getContext()
    {
        return $this->context;
    }

    public function setContext($context): self
    {
        $this->context = $context;

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

    public function getIdLabel(): ?Labels
    {
        return $this->idLabel;
    }

    public function setIdLabel(?Labels $idLabel): self
    {
        $this->idLabel = $idLabel;

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
            $idCv->addIdTraining($this);
        }

        return $this;
    }

    public function removeIdCv(Cv $idCv): self
    {
        if ($this->idCv->contains($idCv)) {
            $this->idCv->removeElement($idCv);
            $idCv->removeIdTraining($this);
        }

        return $this;
    }

}
