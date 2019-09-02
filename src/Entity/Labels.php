<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Labels
 *
 * @ORM\Table(name="labels", indexes={@ORM\Index(name="id_type_label", columns={"id_type_label"})})
 * @ORM\Entity
 */
class Labels
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_label", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idLabel;

    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=45, nullable=false)
     */
    private $label;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creation_date", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $creationDate = 'CURRENT_TIMESTAMP';

    /**
     * @var \LabelTypes
     *
     * @ORM\ManyToOne(targetEntity="LabelTypes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_type_label", referencedColumnName="id_type_label")
     * })
     */
    private $idTypeLabel;

    public function getIdLabel(): ?int
    {
        return $this->idLabel;
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

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTimeInterface $creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    public function getIdTypeLabel(): ?LabelTypes
    {
        return $this->idTypeLabel;
    }

    public function setIdTypeLabel(?LabelTypes $idTypeLabel): self
    {
        $this->idTypeLabel = $idTypeLabel;

        return $this;
    }


}
