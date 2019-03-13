<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypeCv
 *
 * @ORM\Table(name="type_cv")
 * @ORM\Entity
 */
class TypeCv
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_type_cv", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTypeCv;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creation_date", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $creationDate;

    public function getIdTypeCv(): ?int
    {
        return $this->idTypeCv;
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

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTimeInterface $creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    public function __toString()
    {
        return $this->getName();
    }


}
