<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use DateTime;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */
class News
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=300)
     * @Assert\NotBlank()
     * @var string
     */
    protected $title;

    /**
     * @ORM\Column(type="string", length=300)
     * @Assert\Regex("#^[a-z0-9-]+$#")
     * @var string
     */
    protected $url;

    /**
     * @ORM\Column(type="text", nullable = true)
     * @var string|null
     */
    protected $announce;

    /**
     * @ORM\Column(type="text", nullable = true)
     * @var string
     */
    protected $content;

    /**
     * @ORM\Column(type="boolean")
     * @var bool
     */
    protected $enabled;

    /**
     * @ORM\Column(type="datetime")
     * @var DateTime
     */
    protected $publicationDate;

    /**
     * @ORM\Column(type="datetime", nullable = true)
     * @var DateTime
     */
    protected $dateTo;

    /**
     * @ORM\Column(type="datetime")
     * @var DateTime
     */
    protected $createdAt;

    /**
     * @ORM\Column(type="datetime")
     * @var DateTime
     */
    protected $updatedAt;

    /**
     * @ORM\ManyToMany(targetEntity=Projects::class, mappedBy="news")
     * @ORM\JoinColumn(nullable=true)
     */
    private $nkoProjects;

    /**
     * @ORM\ManyToOne(targetEntity=Nko::class, inversedBy="news")
     */
    private $nko;

    public function __construct()
    {
        $this->enabled = false;
        $this->nkoProjects = new ArrayCollection();
        $this->setPublicationDate(new DateTime());
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getTitle() ?: 'n/a';
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersist(): void
    {
        if (!$this->getPublicationDate()) {
            $this->setPublicationDate(new DateTime());
        }
        $this->setCreatedAt(new DateTime());
        $this->setUpdatedAt(new DateTime());
    }

    /**
     * @ORM\PreUpdate
     */
    public function preUpdate(): void
    {
        if (!$this->getPublicationDate()) {
            $this->setPublicationDate(new DateTime());
        }

        $this->setUpdatedAt(new DateTime());
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     * @return string|null
     */
    public function getAnnounce(): ?string
    {
        return $this->announce;
    }

    /**
     * @param string|null $announce
     */
    public function setAnnounce(?string $announce): void
    {
        $this->announce = $announce;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     */
    public function setEnabled(bool $enabled): void
    {
        $this->enabled = $enabled;
    }

    /**
     * @return DateTime
     */
    public function getPublicationDate(): DateTime
    {
        return $this->publicationDate;
    }

    /**
     * @param DateTime $publicationDate
     */
    public function setPublicationDate(DateTime $publicationDate): void
    {
        $this->publicationDate = $publicationDate;
    }

    /**
     * @return DateTime
     */
    public function getDateTo(): DateTime
    {
        return $this->dateTo;
    }

    /**
     * @param DateTime $dateTo
     */
    public function setDateTo(DateTime $dateTo): void
    {
        $this->dateTo = $dateTo;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     */
    public function setCreatedAt(DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTime $updatedAt
     */
    public function setUpdatedAt(DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return ArrayCollection
     */
    public function getNkoProjects(): ArrayCollection
    {
        return $this->nkoProjects;
    }

    /**
     * @param ArrayCollection $nkoProjects
     */
    public function setNkoProjects(ArrayCollection $nkoProjects): void
    {
        $this->nkoProjects = $nkoProjects;
    }


    public function addNkoProject($project): self
    {
        if (!$this->nkoProjects->contains($project)) {
            $this->nkoProjects[] = $project;
            $project->addNews($this);
        }

        return $this;
    }

    public function removeNkoProject($project): self
    {
        if ($this->nkoProjects->removeElement($project)) {
            $project->removeNews($this);
        }

        return $this;
    }
    /**
     * @return mixed
     */
    public function getNko()
    {
        return $this->nko;
    }

    /**
     * @param mixed $nko
     */
    public function setNko($nko): void
    {
        $this->nko = $nko;
    }
}
