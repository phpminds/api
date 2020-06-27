<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Supporters.
 *
 * @ORM\Table(name="supporters", uniqueConstraints={@ORM\UniqueConstraint(name="twitter", columns={"twitter"})})
 * @ORM\Entity
 */
class Supporters
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=60, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=253, nullable=false)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="twitter", type="string", length=15, nullable=false)
     */
    private $twitter;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=254, nullable=false)
     */
    private $email;

    /**
     * @var string|null
     *
     * @ORM\Column(name="logo", type="string", length=250, nullable=true)
     */
    private $logo;
}
