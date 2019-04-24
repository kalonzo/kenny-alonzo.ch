<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Scheduler
 *
 * @ORM\Table(name="scheduler", indexes={@ORM\Index(name="id_label", columns={"id_label"})})
 * @ORM\Entity
 */
class Scheduler
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_schedule", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idSchedule;

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
     * @ORM\ManyToMany(targetEntity="Tasks", mappedBy="idSchedule")
     */
    private $idTask;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idTask = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdSchedule(): ?int
    {
        return $this->idSchedule;
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
     * @return Collection|Tasks[]
     */
    public function getIdTask(): Collection
    {
        return $this->idTask;
    }

    public function addIdTask(Tasks $idTask): self
    {
        if (!$this->idTask->contains($idTask)) {
            $this->idTask[] = $idTask;
            $idTask->addIdSchedule($this);
        }

        return $this;
    }

    public function removeIdTask(Tasks $idTask): self
    {
        if ($this->idTask->contains($idTask)) {
            $this->idTask->removeElement($idTask);
            $idTask->removeIdSchedule($this);
        }

        return $this;
    }

}
