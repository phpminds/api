<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Speakers.
 *
 * @ORM\Table(name="speakers", uniqueConstraints={@ORM\UniqueConstraint(name="twitter", columns={"twitter", "email"})})
 * @ORM\Entity
 */
class Speaker
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private ?int $id = null;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=60, nullable=false)
     */
    private string $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=60, nullable=false)
     */
    private string $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=254, nullable=false)
     */
    private string $email;

    /**
     * @var string|null
     *
     * @ORM\Column(name="twitter", type="string", length=15, nullable=true)
     */
    private ?string $twitter;

    /**
     * @var string|null
     *
     * @ORM\Column(name="avatar", type="text", length=65535, nullable=true)
     */
    private ?string $avatar;

    /**
     * @param string      $firstName
     * @param string      $lastName
     * @param string      $email
     * @param string|null $twitter
     * @param string|null $avatar
     */
    public function __construct(string $firstName, string $lastName, string $email, ?string $twitter, ?string $avatar)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->twitter = $twitter;
        $this->avatar = $avatar;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string|null
     */
    public function getTwitter(): ?string
    {
        return $this->twitter;
    }

    /**
     * @return string|null
     */
    public function getAvatar(): ?string
    {
        return $this->avatar;
    }
}
