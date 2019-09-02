<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Orders
 *
 * @ORM\Table(name="orders", indexes={@ORM\Index(name="id_order_type", columns={"id_order_type"})})
 * @ORM\Entity
 */
class Orders
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_order", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idOrder;

    /**
     * @var int
     *
     * @ORM\Column(name="position", type="integer", nullable=false)
     */
    private $position;

    /**
     * @var \OrderTypes
     *
     * @ORM\ManyToOne(targetEntity="OrderTypes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_order_type", referencedColumnName="id_order_type")
     * })
     */
    private $idOrderType;

    public function getIdOrder(): ?int
    {
        return $this->idOrder;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(int $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getIdOrderType(): ?OrderTypes
    {
        return $this->idOrderType;
    }

    public function setIdOrderType(?OrderTypes $idOrderType): self
    {
        $this->idOrderType = $idOrderType;

        return $this;
    }


}
