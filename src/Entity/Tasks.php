<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Tasks
 *
 * @ORM\Table(name="tasks", indexes={@ORM\Index(name="id_project", columns={"id_project"})})
 * @ORM\Entity
 */
class Tasks
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_task", type="binary", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTask;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="descn", type="blob", length=65535, nullable=true)
     */
    private $descn;

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
     * @var \Projects
     *
     * @ORM\ManyToOne(targetEntity="Projects")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_project", referencedColumnName="id_project")
     * })
     */
    private $idProject;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Scheduler", inversedBy="idTask")
     * @ORM\JoinTable(name="tasks_scheduler",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_task", referencedColumnName="id_task")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_schedule", referencedColumnName="id_schedule")
     *   }
     * )
     */
    private $idSchedule;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idSchedule = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdTask(): ?int
    {
        return $this->idTask;
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

    public function getDescn()
    {
        return $this->descn;
    }

    public function setDescn($descn): self
    {
        $this->descn = $descn;

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

    public function getIdProject(): ?Projects
    {
        return $this->idProject;
    }

    public function setIdProject(?Projects $idProject): self
    {
        $this->idProject = $idProject;

        return $this;
    }

    /**
     * @return Collection|Scheduler[]
     */
    public function getIdSchedule(): Collection
    {
        return $this->idSchedule;
    }

    public function addIdSchedule(Scheduler $idSchedule): self
    {
        if (!$this->idSchedule->contains($idSchedule)) {
            $this->idSchedule[] = $idSchedule;
        }

        return $this;
    }

    public function removeIdSchedule(Scheduler $idSchedule): self
    {
        if ($this->idSchedule->contains($idSchedule)) {
            $this->idSchedule->removeElement($idSchedule);
        }

        return $this;
    }

}
