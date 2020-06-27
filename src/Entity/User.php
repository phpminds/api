<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Users.
 *
 * @ORM\Table(name="users", uniqueConstraints={@ORM\UniqueConstraint(name="email", columns={"email"})}, indexes={@ORM\Index(name="status", columns={"status"})})
 * @ORM\Entity
 */
class User
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
     * @ORM\Column(name="email", type="string", length=120, nullable=false)
     */
    private string $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=60, nullable=false, options={"fixed"=true})
     */
    private string $password;

    /**
     * @var int
     *
     * @ORM\Column(name="role", type="integer", nullable=false)
     */
    private int $role;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer", nullable=false)
     */
    private int $status;

    /**
     * @param string $email
     * @param string $password
     * @param int    $role
     * @param int    $status
     */
    public function __construct(string $email, string $password, int $role, int $status)
    {
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->status = $status;
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
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return int
     */
    public function getRole(): int
    {
        return $this->role;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }
}
