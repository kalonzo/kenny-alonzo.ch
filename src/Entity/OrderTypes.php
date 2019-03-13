<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OrderTypes
 *
 * @ORM\Table(name="order_types")
 * @ORM\Entity
 */
class OrderTypes
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_order_type", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idOrderType;

    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=45, nullable=false)
     */
    private $label;

    public function getIdOrderType(): ?int
    {
        return $this->idOrderType;
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


}
