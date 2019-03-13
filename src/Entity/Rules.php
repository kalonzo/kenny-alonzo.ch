<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rules
 *
 * @ORM\Table(name="rules")
 * @ORM\Entity
 */
class Rules
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_rule", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idRule;

    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=45, nullable=false)
     */
    private $label;

    /**
     * @var string
     *
     * @ORM\Column(name="descn", type="blob", length=65535, nullable=false)
     */
    private $descn;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creation_date", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $creationDate = 'CURRENT_TIMESTAMP';

    public function getIdRule(): ?int
    {
        return $this->idRule;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

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


}
