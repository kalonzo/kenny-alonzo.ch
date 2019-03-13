<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Departments
 *
 * @ORM\Table(name="departments", indexes={@ORM\Index(name="id_country", columns={"id_country"})})
 * @ORM\Entity
 */
class Departments
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_department", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDepartment;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    private $name;

    /**
     * @var \Countries
     *
     * @ORM\ManyToOne(targetEntity="Countries")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_country", referencedColumnName="id_country")
     * })
     */
    private $idCountry;

    public function getIdDepartment(): ?int
    {
        return $this->idDepartment;
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

    public function getIdCountry(): ?Countries
    {
        return $this->idCountry;
    }

    public function setIdCountry(?Countries $idCountry): self
    {
        $this->idCountry = $idCountry;

        return $this;
    }

    public function __toString()
    {
        return $this->getName();
    }
}
