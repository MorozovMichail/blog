<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Ссылки на социальные сети (SocialNetwork)
 *
 * @ORM\Entity
 * @ORM\Table(name="nko_social_network")
 * @ORM\HasLifecycleCallbacks()
 *
 */
class SocialNetwork
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @var string
     */
    protected $src;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SocialNetworkType", inversedBy="socialNetworks")
     */
    protected $type;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Nko", inversedBy="socialNetworks")
     */
    protected $nko;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getSrc()
    {
        return $this->src;
    }

    /**
     * @param string $src
     */
    public function setSrc(string $src)
    {
        $this->src = $src;
    }


    /**
     * @return SocialNetworkType
     */
    public function getType()
    {
        return $this->type;
    }


    /**
     * @param SocialNetworkType $type
     * @return $this
     */
    public function setType(SocialNetworkType $type)
    {
        $this->type = $type;

        return $this;
    }

    public function __toString()
    {
        return $this->src;
    }

    /**
     * @return Nko
     */
    public function getNko(): ?Nko
    {
        return $this->nko;
    }

    /**
     * @param Nko $nko
     * @return SocialNetwork
     */
    public function setNko(Nko $nko)
    {
        $this->nko = $nko;

        return $this;
    }
}
