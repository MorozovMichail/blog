<?php

namespace App\Entity;

//use App\Entity\Event;
use Doctrine\ORM\Mapping as ORM;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\MaxDepth;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 */
class Nko
{
    const NKO_STATUS_ABANDONED= 0;
    const NKO_STATUS_ACTIVE = 1;
    const NKO_STATUS_ABANDONING = 2;

    const TYPE_NKO_OIV = 1;
    const TYPE_SO_NKO = 2;

    /**
     * @Serializer\Exclude()
     */
    public static $nkoStatuses = [
        'ликвидирована'=>self::NKO_STATUS_ABANDONED,
        'действующая'=>self::NKO_STATUS_ACTIVE,
        'ликвидируется'=>self::NKO_STATUS_ABANDONING,
    ];

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"list", "item"})
     */
    protected $id;

    /**
     * @ORM\Column(type="string", nullable=false)
     * @Assert\NotBlank()
     * @Groups({"list", "item"})
     */
    protected $title;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $agreement;


    //Регистрационные данные

    /**
     * @ORM\Column(type="bigint", nullable=false)
     * @Assert\NotBlank()
     * @Assert\Range(
     *      min = 1000000000,
     *      max = 9999999999
     * )
     * @Groups({"list", "item"})
     */
    protected $inn;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\Length(max=13)
     * @Groups({"list", "item"})
     */
    protected $ogrn;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"list", "item"})
     */
    protected $longName;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"list", "item"})
     */
    protected $shortName;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @var Datetime
     */
    protected $yegryulDate;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @var Datetime
     */
    protected $registrationDate;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    protected $okved;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    protected $okved2;

    //Юридический адрес

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     * @Assert\Length(max=6)
     */
    protected $legalZip;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    protected $legalCity;

    /**
     * @ORM\Column(type="string", nullable = true)
     * @var string
     */
    protected $legalStreet;

    /**
     * @ORM\Column(type="string", nullable = true)
     * @var string
     */
    protected $legalHouse;

    /**
     * @ORM\Column(type="string", nullable = true)
     * @var string
     */
    protected $legalPavilion;

    /**
     * @ORM\Column(type="string", nullable = true)
     * @var string
     */
    protected $legalOffice;

    /**
     * @ORM\Column(type="string", nullable = true)
     * @var string
     */
    protected $legalDistrict;

    /**
     * @ORM\Column(type="string", nullable = true)
     * @var string
     */
    protected $legalAddress;

    // Банковские реквизиты

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    protected $bankName;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     * @Assert\Length(max=12)
     */
    protected $bankInn;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     * @Assert\Length(max=9)
     */
    protected $bankKpp;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     * @Assert\Length(max=9)
     */
    protected $bankBik;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     * @Assert\Length(max=20)
     */
    protected $bankKSchet;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     * @Assert\Length(max=20)
     */
    protected $rSchet;


    // Связь с организацией
    /**
     * @ORM\Column(type="string", nullable = false)
     * @Assert\NotBlank()
     * @var string
     */
    protected $phone;

    /**
     * @ORM\Column(type="string", nullable = false)
     * @Assert\Email()
     * @Assert\NotBlank()
     * @Assert\Length(max=255)
     * @var string
     */
    protected $email;

    /**
     * @ORM\Column(type="string", nullable = true)
     * @var string
     */
    protected $site;

    /**
     * @ORM\OneToMany(targetEntity=SocialNetwork::class, mappedBy="nko", cascade={"persist"}, orphanRemoval=true)
     * @var Collection|SocialNetwork[]
     */
    protected $socialNetworks;

    /**
     * @ORM\OneToMany(targetEntity=News::class, mappedBy="nko")
     */
    private $news;

    /**
     * @ORM\OneToMany(targetEntity=Ads::class, mappedBy="nko")
     */
    private $ads;

    /**
     * @ORM\OneToMany(targetEntity=MentoringPrograms::class, mappedBy="nko")
     */
    private $mentoringPrograms;

    /**
     * @ORM\OneToMany(targetEntity=Vacancy::class, mappedBy="nko")
     */
    private $vacancies;

    /**
     * @ORM\OneToMany(targetEntity=Projects::class, mappedBy="nko",
     *      cascade={"all"}, orphanRemoval=true)
     */
    private $projects;

//    /**
//     * @ORM\OneToMany(targetEntity=Event::class, mappedBy="nko")
//     */
//    private $nkoEvents;

    /**
     * @ORM\OneToMany(targetEntity=NkoRoles::class, mappedBy="nko")
     * @Serializer\Exclude()
     */
    private $nkoRoles;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $blockedAt;

    /**
     * @ORM\Column(type="smallint")
     */
    private $nkoStatus;

    /**
     * @ORM\Column(type="bigint", nullable=true)
     * @Assert\Range(
     *      min = 10000000,
     *      max = 9999999999
     * )
     */
    private $okpo;

    /**
     * @ORM\Column(type="bigint", nullable=true)
     * @Assert\Range(
     *      min = 100000000,
     *      max = 999999999
     * )
     */
    private $kpp;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     * @Groups({"list", "item"})
     */
    private $type;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string|null
     */
    private $managementName;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string|null
     */
    private $managementPost;

    /**
     * Nko constructor.
     */
    public function __construct()
    {
        $this->nkoRoles = new ArrayCollection();
        $this->socialNetworks = new ArrayCollection();
        $this->news = new ArrayCollection();
        $this->ads = new ArrayCollection();
        $this->mentoringPrograms = new ArrayCollection();
        $this->vacancies = new ArrayCollection();
        $this->projects = new ArrayCollection();
        $this->nkoStatus = self::NKO_STATUS_ACTIVE;
    }

    /**
     * Get id.
     *
     * @return int $id
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getTitle() ?: 'n/a';
    }

    /**
     * @param $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getInn()
    {
        return $this->inn;
    }

    /**
     * @param string $inn
     */
    public function setInn($inn)
    {
        $this->inn = $inn;
    }

    /**
     * @return string
     */
    public function getOgrn()
    {
        return $this->ogrn;
    }

    /**
     * @param string $ogrn
     */
    public function setOgrn($ogrn)
    {
        $this->ogrn = $ogrn;
    }

    /**
     * @return string
     */
    public function getLongName()
    {
        return $this->longName;
    }

    /**
     * @param string $longName
     */
    public function setLongName($longName)
    {
        $this->longName = $longName;
    }

    /**
     * @return string
     */
    public function getShortName()
    {
        return $this->shortName;
    }

    /**
     * @param string $shortName
     */
    public function setShortName($shortName)
    {
        $this->shortName = $shortName;
    }

    public function getYegryulDate():?DateTime
    {
        return $this->yegryulDate;
    }

    public function setYegryulDate(?DateTime $yegryulDate):self
    {
        $this->yegryulDate = $yegryulDate;
        return $this;
    }

    public function getRegistrationDate():?DateTime
    {
        return $this->registrationDate;
    }

    public function setRegistrationDate(?DateTime $registrationDate):self
    {
        $this->registrationDate = $registrationDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getOkved()
    {
        return $this->okved;
    }

    /**
     * @param string $okved
     */
    public function setOkved($okved)
    {
        $this->okved = $okved;
    }

    /**
     * @return string
     */
    public function getOkved2()
    {
        return $this->okved2;
    }

    /**
     * @param string $okved2
     */
    public function setOkved2($okved2)
    {
        $this->okved2 = $okved2;
    }

    /**
     * @return string
     */
    public function getLegalZip()
    {
        return $this->legalZip;
    }

    /**
     * @param string $legalZip
     */
    public function setLegalZip($legalZip)
    {
        $this->legalZip = $legalZip;
    }

    /**
     * @return string
     */
    public function getLegalCity()
    {
        return $this->legalCity;
    }

    /**
     * @param string $legalCity
     */
    public function setLegalCity($legalCity)
    {
        $this->legalCity = $legalCity;
    }

    /**
     * @return string
     */
    public function getLegalStreet()
    {
        return $this->legalStreet;
    }

    /**
     * @param string $legalStreet
     */
    public function setLegalStreet($legalStreet)
    {
        $this->legalStreet = $legalStreet;
    }

    /**
     * @return string
     */
    public function getLegalHouse()
    {
        return $this->legalHouse;
    }

    /**
     * @param string $legalHouse
     */
    public function setLegalHouse($legalHouse)
    {
        $this->legalHouse = $legalHouse;
    }

    /**
     * @return string
     */
    public function getLegalPavilion()
    {
        return $this->legalPavilion;
    }

    /**
     * @param string $legalPavilion
     */
    public function setLegalPavilion($legalPavilion)
    {
        $this->legalPavilion = $legalPavilion;
    }

    /**
     * @return string
     */
    public function getLegalOffice()
    {
        return $this->legalOffice;
    }

    /**
     * @param string $legalOffice
     */
    public function setLegalOffice($legalOffice)
    {
        $this->legalOffice = $legalOffice;
    }

    /**
     * @return string
     */

    /**
     * @return string
     */
    public function getBankName()
    {
        return $this->bankName;
    }

    /**
     * @param string $bankName
     */
    public function setBankName($bankName)
    {
        $this->bankName = $bankName;
    }

    /**
     * @return string
     */
    public function getBankInn()
    {
        return $this->bankInn;
    }

    /**
     * @param string $bankInn
     */
    public function setBankInn($bankInn)
    {
        $this->bankInn = $bankInn;
    }

    /**
     * @return string
     */
    public function getBankKpp()
    {
        return $this->bankKpp;
    }

    /**
     * @param string $bankKpp
     */
    public function setBankKpp($bankKpp)
    {
        $this->bankKpp = $bankKpp;
    }

    /**
     * @return string
     */
    public function getBankBik()
    {
        return $this->bankBik;
    }

    /**
     * @param string $bankBik
     */
    public function setBankBik($bankBik)
    {
        $this->bankBik = $bankBik;
    }

    /**
     * @return string
     */
    public function getBankKSchet()
    {
        return $this->bankKSchet;
    }

    /**
     * @param string $bankKSchet
     */
    public function setBankKSchet($bankKSchet)
    {
        $this->bankKSchet = $bankKSchet;
    }

    /**
     * @return string
     */
    public function getRSchet()
    {
        return $this->rSchet;
    }

    /**
     * @param string $rSchet
     */
    public function setRSchet($rSchet)
    {
        $this->rSchet = $rSchet;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * @param string $site
     */
    public function setSite($site)
    {
        $this->site = $site;
    }

    /**
     * @return SocialNetwork[]|ArrayCollection|Collection
     */
    public function getSocialNetworks()
    {
        return $this->socialNetworks;
    }

    /**
     * @param $socialNetworks
     */
    public function setSocialNetworks($socialNetworks): void
    {
        $this->socialNetworks = $socialNetworks;
    }

    /**
     * @param SocialNetwork $socialNetwork
     */
    public function addSocialNetwork(SocialNetwork $socialNetwork): void
    {
        if (!$this->socialNetworks->contains($socialNetwork)) {
            $socialNetwork->setNko($this);
            $this->socialNetworks->add($socialNetwork);
        }
    }

    /**
     * @param SocialNetwork $socialNetwork
     */
    public function removeSocialNetwork(SocialNetwork $socialNetwork)
    {
        $this->socialNetworks->removeElement($socialNetwork);
    }

    /**
     * @return Collection|News[]
     */
    public function getNews(): Collection
    {
        return $this->news;
    }

    public function addNews(News $news): self
    {
        if (!$this->news->contains($news)) {
            $this->news[] = $news;
            $news->addNko($this);
        }

        return $this;
    }

    public function removeNews(News $news): self
    {
        if ($this->news->removeElement($news)) {
            $news->removeNko($this);
        }

        return $this;
    }

    /**
     * @return Collection|Ads[]
     */
    public function getAds(): Collection
    {
        return $this->news;
    }

    /**
     * @return Collection|Projects[]
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function addProject(Projects $project): self
    {
        if (!$this->projects->contains($project)) {
            $this->projects[] = $project;
            $project->setNko($this);
        }

        return $this;
    }

    public function removeProject(Projects $project): self
    {
        if ($this->projects->removeElement($project)) {
            // set the owning side to null (unless already changed)
            if ($project->getNko() === $this) {
                $project->setNko(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Vacancy[]
     */
    public function getVacancies(): Collection
    {
        return $this->vacancies;
    }

    /**
     * @return Collection|MentoringPrograms[]
     */
    public function getMentoringPrograms(): Collection
    {
        return $this->mentoringPrograms;
    }

    public function hasEmployees(){
        return $this->nkoRoles->count() > 0;
    }

    public function getAgreement()
    {
        return $this->agreement;
    }

    public function setAgreement($agreement)
    {
        $this->agreement = $agreement;
        return $this;
    }

    public function getNkoRoles(){
        return $this->nkoRoles;
    }

    /**
     * @return mixed
     */
    public function getBlockedAt()
    {
        return $this->blockedAt;
    }

    /**
     * @param mixed $blockedAt
     * @return Nko
     */
    public function setBlockedAt($blockedAt)
    {
        $this->blockedAt = $blockedAt;
        return $this;
    }

    public function getNkoStatus(): ?int
    {
        return $this->nkoStatus;
    }

    public function setNkoStatus(int $nkoStatus): self
    {
        $this->nkoStatus = $nkoStatus;

        return $this;
    }

    public function getNkoStatusAsString(){
        return array_flip(self::$nkoStatuses)[$this->nkoStatus ?? self::NKO_STATUS_ACTIVE];
    }

    public function getOkpo(): ?string
    {
        return $this->okpo;
    }

    public function setOkpo(?string $okpo): self
    {
        $this->okpo = $okpo;

        return $this;
    }

    public function getKpp(): ?string
    {
        return $this->kpp;
    }

    public function setKpp(?string $kpp): self
    {
        $this->kpp = $kpp;

        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(?int $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getManagementName(): ?string
    {
        return $this->managementName;
    }

    /**
     * @param string|null $managementName
     * @return $this
     */
    public function setManagementName(?string $managementName): self
    {
        $this->managementName = $managementName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getManagementPost(): ?string
    {
        return $this->managementPost;
    }

    /**
     * @param string|null $managementPost
     * @return $this
     */
    public function setManagementPost(?string $managementPost): self
    {
        $this->managementPost = $managementPost;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLegalDistrict(): ?string
    {
        return $this->legalDistrict;
    }

    /**
     * @param string|null $legalDistrict
     * @return $this
     */
    public function setLegalDistrict(?string $legalDistrict): self
    {
        $this->legalDistrict = $legalDistrict;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLegalAddress(): ?string
    {
        return $this->legalAddress;
    }

    /**
     * @param string|null $legalAddress
     * @return $this
     */
    public function setLegalAddress(?string $legalAddress): self
    {
        $this->legalAddress = $legalAddress;

        return $this;
    }
}
