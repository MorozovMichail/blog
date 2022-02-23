<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */
class Vacancy
{
    public const VACANCY_OPEN = 0;
    public const VACANCY_CLOSE = 1;

    protected static $vacancyStatuses = [
        self::VACANCY_OPEN => 'Открыта',
        self::VACANCY_CLOSE => 'Закрыта',
    ];

    public const VOLUNTEERS = 0;
    public const SPECIALISTS = 1;
    public const NKO = 2;

    protected static $targetAudiences = [
        self::VOLUNTEERS => 'Волонтеры',
        self::SPECIALISTS => 'Специалисты',
        self::NKO => 'НКО',
    ];


    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $title;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isHot;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */
    private $targetAudience;

    /**
     * @ORM\ManyToOne(targetEntity=VacancyCategories::class)
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank()
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=500)
     * @Assert\NotBlank()
     * @Assert\Length(max=500)
     */
    private $shortDescription;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    private $fullDescription;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    private $duties;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    private $conditions;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $contactPhone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Email()
     */
    private $contactEmail;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $publicationDate;

    /**
     * @ORM\Column(type="integer")
     */
    private $vacancyStatus;

    /**
     * @ORM\ManyToOne(targetEntity=Projects::class)
     * @ORM\JoinColumn(nullable=true)
     */
    private $project;

    /**
     * @ORM\ManyToOne(targetEntity=Nko::class, inversedBy="vacancies")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $nko;

    /**
     * @ORM\ManyToMany(targetEntity=Skills::class)
     */
    private $skills;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $price;

    public function __construct()
    {
        $this->publicationDate = new \DateTime("now");
        $this->skills = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): ?self
    {
        $this->title = $title;

        return $this;
    }

    public function getIsHot(): ?bool
    {
        return $this->isHot;
    }

    public function setIsHot(bool $isHot): self
    {
        $this->isHot = $isHot;

        return $this;
    }

    public function getTargetAudience(): ?int
    {
        return $this->targetAudience;
    }

    public function setTargetAudience(int $targetAudience): self
    {
        $this->targetAudience = $targetAudience;

        return $this;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory($category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    public function setShortDescription(string $shortDescription): self
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    public function getFullDescription(): ?string
    {
        return $this->fullDescription;
    }

    public function setFullDescription(string $fullDescription): self
    {
        $this->fullDescription = $fullDescription;

        return $this;
    }

    public function getDuties(): ?string
    {
        return $this->duties;
    }

    public function setDuties(string $duties): self
    {
        $this->duties = $duties;

        return $this;
    }

    public function getProject()
    {
        return $this->project;
    }

    public function setProject($project): Vacancy
    {
        $this->project = $project;
        return $this;
    }


    public function getConditions(): ?string
    {
        return $this->conditions;
    }

    public function setConditions(?string $conditions): self
    {
        $this->conditions = $conditions;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getContactPhone(): ?string
    {
        return $this->contactPhone;
    }

    public function setContactPhone(?string $contactPhone): self
    {
        $this->contactPhone = $contactPhone;

        return $this;
    }

    public function getContactEmail(): ?string
    {
        return $this->contactEmail;
    }

    public function setContactEmail(?string $contactEmail): self
    {
        $this->contactEmail = $contactEmail;

        return $this;
    }

    public function getPublicationDate(): ?\DateTimeInterface
    {
        return $this->publicationDate;
    }

    public function setPublicationDate(?\DateTimeInterface $publicationDate): self
    {
        $this->publicationDate = $publicationDate;

        return $this;
    }

    public function getVacancyStatus(): ?int
    {
        return $this->vacancyStatus;
    }

    public function setVacancyStatus(int $vacancyStatus): self
    {
        $this->vacancyStatus = $vacancyStatus;

        return $this;
    }

    public function __toString()
    {
        return (string)$this->title;
    }

    /**
     * @param mixed $nko
     * @return Vacancy
     */
    public function setNko($nko)
    {
        $this->nko = $nko;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNko(): ?Nko
    {
        return $this->nko;
    }

    public function getVacancyStatusAsString()
    {
        return self::$vacancyStatuses[$this->vacancyStatus];
    }

    public function getTargetAudienceAsString()
    {
        return self::$targetAudiences[$this->targetAudience];
    }

    public function getSkills(): Collection
    {
        return $this->skills;
    }

    public function setSkills($skills)
    {
        $this->skills = $skills;
    }

    public function addSkill($skill)
    {
        $this->skills[] = $skill;
    }

    public function removeSkill($skill): self
    {
        if ($this->skills->removeElement($skill)) {
            $skill->removeNkoVacancy($this);
        }

        return $this;
    }

    /**
     * @return float|null
     */
    public function getPrice(): ?float
    {
        return $this->price;
    }

    /**
     * @param float|null $price
     * @return Vacancy
     */
    public function setPrice(?float $price): self
    {
        $this->price = $price;
        return $this;
    }

}
