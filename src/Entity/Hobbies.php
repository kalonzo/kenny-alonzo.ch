<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Utils\Tools;

/**
 * Hobbies
 *
 * @ORM\Table(name="hobbies", indexes={@ORM\Index(name="id_order", columns={"id_order"}), @ORM\Index(name="id_label", columns={"id_label"})})
 * @ORM\Entity
 */
class Hobbies
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_hobbie", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idHobbie;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creation_date", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $creationDate = 'CURRENT_TIMESTAMP';

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
     * @ORM\ManyToMany(targetEntity="Cv", mappedBy="idHobbie")
     */
    private $idCv;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idCv = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdHobbie(): ?int
    {
        return $this->idHobbie;
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
            $idCv->addIdHobbie($this);
        }

        return $this;
    }

    public function removeIdCv(Cv $idCv): self
    {
        if ($this->idCv->contains($idCv)) {
            $this->idCv->removeElement($idCv);
            $idCv->removeIdHobbie($this);
        }

        return $this;
    }

}
