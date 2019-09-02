<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LabelTypes
 *
 * @ORM\Table(name="label_types")
 * @ORM\Entity
 */
class LabelTypes
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_type_label", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTypeLabel;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=45, nullable=false)
     */
    private $type;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creation_date", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $creationDate = 'CURRENT_TIMESTAMP';

    public function getIdTypeLabel(): ?int
    {
        return $this->idTypeLabel;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

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
