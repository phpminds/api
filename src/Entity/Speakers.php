<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Speakers.
 *
 * @ORM\Table(name="speakers", uniqueConstraints={@ORM\UniqueConstraint(name="twitter", columns={"twitter", "email"})})
 * @ORM\Entity
 */
class Speakers
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
     * @ORM\Column(name="first_name", type="string", length=60, nullable=false)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=60, nullable=false)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=254, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="twitter", type="string", length=15, nullable=false)
     */
    private $twitter;

    /**
     * @var string|null
     *
     * @ORM\Column(name="avatar", type="text", length=65535, nullable=true)
     */
    private $avatar;
}
