<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 */
class NkoRoles
{
    public const ROLE_NONE = 0;
    public const ROLE_MEMBER = 30;
    public const ROLE_EDITOR = 70;
    public const ROLE_DIRECTOR = 100;

    /**
     * @Serializer\Exclude()
     */
    public static $roles = [
        'nko.role.none' => self::ROLE_NONE,
        'nko.role.member' => self::ROLE_MEMBER,
        'nko.role.editor' => self::ROLE_EDITOR,
        'nko.role.director' => self::ROLE_DIRECTOR,
    ];


    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Nko::class, inversedBy="nkoRoles")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $nko;

    /**
     * @ORM\Column(type="string")
     */
    private $employee;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */
    private $role;

    /**
     * NkoRoles constructor.
     */
    public function __construct()
    {
        $this->role = self::ROLE_NONE;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string)$this->employee;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string[]
     */
    public function getLkSectionAndSuffix(): array
    {
        return ['employees', 'roles'];
    }

    /**
     * @return Nko|null
     */
    public function getNko(): ?Nko
    {
        return $this->nko;
    }

    /**
     * @param Nko|null $nko
     * @return $this
     */
    public function setNko(?Nko $nko): self
    {
        $this->nko = $nko;

        return $this;
    }

    public function getEmployee()
    {
        return $this->employee;
    }

    public function setEmployee($employee): self
    {
        $this->employee = $employee;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getRole(): ?int
    {
        return $this->role;
    }

    /**
     * @param int $role
     * @return $this
     */
    public function setRole(int $role): self
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getRoleAsString()
    {
        return array_flip(self::$roles)[$this->role];
    }
}
