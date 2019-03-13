<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserRules
 *
 * @ORM\Table(name="user_rules", indexes={@ORM\Index(name="id_rule", columns={"id_rule"})})
 * @ORM\Entity
 */
class UserRules
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="id_rule", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idRule;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdRule(): ?int
    {
        return $this->idRule;
    }


}
