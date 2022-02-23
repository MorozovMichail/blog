<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 */
class Projects
{
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
    private $briefDescription;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    private $fullDescription;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $datePublish;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateBegin;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateEnd;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $workProgress;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $linkToSite;

    /**
     * @ORM\OneToMany(targetEntity=ProjectStages::class, mappedBy="project",
     *      cascade={"all"}, orphanRemoval=true)
     */
    private $projectStages;

    /**
     * @ORM\ManyToOne(targetEntity=Nko::class, inversedBy="projects")
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    private $nko;

    /**
     * @ORM\ManyToMany(targetEntity=News::class, inversedBy="nkoProjects")
     * @ORM\JoinTable(name="nko_projects_news")
     */
    private $news;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $outputBankDetails;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $expertAssessment;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $grantAmount;

    /**
     * @ORM\ManyToMany(targetEntity=ProjectsGroups::class)
     */
    private $projectGroups;

    /**
     * @ORM\OneToMany(targetEntity=ProjectResults::class, mappedBy="project",
     *      cascade={"all"}, orphanRemoval=true)
     */
    private $projectResults;

    /**
     * @ORM\Column(type="boolean", options={"default": true})
     * @var bool
     */
    private $enabled;

    public function __toString()
    {
        return $this->title;
    }

    public function __construct()
    {
        $this->datePublish = new \DateTime();
        $this->enabled = true;
        $this->outputBankDetails = false;
        $this->projectStages = new ArrayCollection();
        $this->projectResults = new ArrayCollection();
        $this->news = new ArrayCollection();
        $this->projectGroups = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
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
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getBriefDescription()
    {
        return $this->briefDescription;
    }

    /**
     * @param mixed $briefDescription
     */
    public function setBriefDescription($briefDescription): void
    {
        $this->briefDescription = $briefDescription;
    }

    /**
     * @return mixed
     */
    public function getFullDescription()
    {
        return $this->fullDescription;
    }

    /**
     * @param mixed $fullDescription
     */
    public function setFullDescription($fullDescription): void
    {
        $this->fullDescription = $fullDescription;
    }

    /**
     * @return \DateTime
     */
    public function getDatePublish(): \DateTime
    {
        return $this->datePublish;
    }

    /**
     * @param \DateTime $datePublish
     */
    public function setDatePublish(\DateTime $datePublish): void
    {
        $this->datePublish = $datePublish;
    }

    /**
     * @return mixed
     */
    public function getDateBegin()
    {
        return $this->dateBegin;
    }

    /**
     * @param mixed $dateBegin
     */
    public function setDateBegin($dateBegin): void
    {
        $this->dateBegin = $dateBegin;
    }

    /**
     * @return mixed
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * @param mixed $dateEnd
     */
    public function setDateEnd($dateEnd): void
    {
        $this->dateEnd = $dateEnd;
    }

    /**
     * @return mixed
     */
    public function getWorkProgress()
    {
        return $this->workProgress;
    }

    /**
     * @param mixed $workProgress
     */
    public function setWorkProgress($workProgress): void
    {
        $this->workProgress = $workProgress;
    }

    /**
     * @return mixed
     */
    public function getLinkToSite()
    {
        return $this->linkToSite;
    }

    /**
     * @param mixed $linkToSite
     */
    public function setLinkToSite($linkToSite): void
    {
        $this->linkToSite = $linkToSite;
    }

    /**
     * @return ArrayCollection
     */
    public function getProjectStages(): ArrayCollection
    {
        return $this->projectStages;
    }

    public function addProjectStage($projectStage): self
    {
        if (!$this->projectStages->contains($projectStage)) {
            $this->projectStages[] = $projectStage;
            $projectStage->setProject($this);
        }

        return $this;
    }

    public function removeProjectStage($projectStage): self
    {
        if ($this->projectStages->contains($projectStage)) {
            $this->projectStages->removeElement($projectStage);
            // set the owning side to null (unless already changed)
            if ($projectStage->getProject() === $this) {
                $projectStage->setProject(null);
            }
        }

        return $this;
    }

    /**
     * @param ArrayCollection $projectStages
     */
    public function setProjectStages(ArrayCollection $projectStages): void
    {
        $this->projectStages = $projectStages;
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

    /**
     * @return ArrayCollection
     */
    public function getNews(): ArrayCollection
    {
        return $this->news;
    }

    public function addNews($news): self
    {
        if (!$this->news->contains($news)) {
            $this->news[] = $news;
        }

        return $this;
    }

    public function removeNews($news): self
    {
        $this->news->removeElement($news);

        return $this;
    }

    /**
     * @param ArrayCollection $news
     */
    public function setNews(ArrayCollection $news): void
    {
        $this->news = $news;
    }

    /**
     * @return false
     */
    public function getOutputBankDetails(): bool
    {
        return $this->outputBankDetails;
    }

    /**
     * @param false $outputBankDetails
     */
    public function setOutputBankDetails(bool $outputBankDetails): void
    {
        $this->outputBankDetails = $outputBankDetails;
    }

    /**
     * @return mixed
     */
    public function getExpertAssessment()
    {
        return $this->expertAssessment;
    }

    /**
     * @param mixed $expertAssessment
     */
    public function setExpertAssessment($expertAssessment): void
    {
        $this->expertAssessment = $expertAssessment;
    }

    /**
     * @return mixed
     */
    public function getGrantAmount()
    {
        return $this->grantAmount;
    }

    /**
     * @param mixed $grantAmount
     */
    public function setGrantAmount($grantAmount): void
    {
        $this->grantAmount = $grantAmount;
    }

    /**
     * @return ArrayCollection
     */
    public function getProjectGroups(): ArrayCollection
    {
        return $this->projectGroups;
    }

    public function addProjectGroup($projectGroup): self
    {
        if (!$this->projectGroups->contains($projectGroup)) {
            $this->projectGroups[] = $projectGroup;
        }

        return $this;
    }

    public function removeProjectGroup($projectGroup): self
    {
        $this->projectGroups->removeElement($projectGroup);

        return $this;
    }

    /**
     * @param ArrayCollection $projectGroups
     */
    public function setProjectGroups(ArrayCollection $projectGroups): void
    {
        $this->projectGroups = $projectGroups;
    }

    /**
     * @return ArrayCollection
     */
    public function getProjectResults(): ArrayCollection
    {
        return $this->projectResults;
    }

    public function addProjectResult($projectResult): self
    {
        if (!$this->projectResults->contains($projectResult)) {
            $this->projectResults[] = $projectResult;
            $projectResult->setProject($this);
        }

        return $this;
    }

    public function removeProjectResult($projectResult): self
    {
        if ($this->projectResults->contains($projectResult)) {
            $this->projectResults->removeElement($projectResult);
            // set the owning side to null (unless already changed)
            if ($projectResult->getProject() === $this) {
                $projectResult->setProject(null);
            }
        }

        return $this;
    }

    /**
     * @param ArrayCollection $projectResults
     */
    public function setProjectResults(ArrayCollection $projectResults): void
    {
        $this->projectResults = $projectResults;
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


}
