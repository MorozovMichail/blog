<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */
class MentoringPrograms
{
    public const VOLUNTEERS = 0;
    public const SPECIALISTS = 1;
    public const NKO = 2;

    protected static $labels = [
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
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    private $description;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $targetAudience;

    /**
     * @ORM\ManyToOne(targetEntity=MentoringCategories::class)
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank()
     */
    private $category;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $format;

    /**
     * @ORM\ManyToOne(targetEntity=Nko::class, inversedBy="mentoringPrograms")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $nko;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return MentoringPrograms
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     * @return MentoringPrograms
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTargetAudience()
    {
        return $this->targetAudience;
    }

    /**
     * @param mixed $targetAudience
     * @return MentoringPrograms
     */
    public function setTargetAudience($targetAudience)
    {
        $this->targetAudience = $targetAudience;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     * @return MentoringPrograms
     */
    public function setCategory($category)
    {
        $this->category = $category;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @param mixed $format
     */
    public function setFormat($format)
    {
        $this->format = $format;
        return $this;
    }

    /**
     * @param mixed $status
     * @return MentoringPrograms
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @param mixed $nko
     * @return MentoringPrograms
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

    public function __toString()
    {
        return $this->getTitle() ?: 'n/a';
    }

    /**
     * @param null $format
     * @return mixed
     */
    public function getFormatAsString($format = null)
    {
        if ($format) {
            return self::$labels[$format];
        } else {
            return self::$labels[$this->format];
        }
    }

    public function getTargetAudienceAsString()
    {
        return self::$labels[$this->targetAudience];
    }

}
