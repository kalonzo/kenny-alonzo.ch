<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WorkingLicense
 *
 * @ORM\Table(name="working_license")
 * @ORM\Entity
 */
class WorkingLicense
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_working_license", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idWorkingLicense;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="duration", type="string", length=45, nullable=false)
     */
    private $duration;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creation_date", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $creationDate = 'CURRENT_TIMESTAMP';

    public function getIdWorkingLicense(): ?int
    {
        return $this->idWorkingLicense;
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

    public function getDuration(): ?string
    {
        return $this->duration;
    }

    public function setDuration(string $duration): self
    {
        $this->duration = $duration;

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
