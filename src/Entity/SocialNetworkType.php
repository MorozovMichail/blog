<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sonata\MediaBundle\Model\MediaInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="nko_social_network_type")
 * @ORM\HasLifecycleCallbacks()
 *
 */
class SocialNetworkType
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(type="string", unique=true)
     * @Assert\NotBlank()
     * @var string
     */
    protected $title;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SocialNetwork", mappedBy="type")
     */
    protected $socialNetworks;

    /**
     * Get id.
     *
     * @return int $id
     */
    public function getId()
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

    public function __toString()
    {
        return $this->getTitle() ?: 'n/a';
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title)
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
     * @return SocialNetwork
     */
    public function getSocialNetwork(): SocialNetwork
    {
        return $this->socialNetworks;
    }

    /**
     * @param SocialNetwork $socialNetwork
     * @return SocialNetworkType
     */
    public function setSocialNetwork(SocialNetwork $socialNetwork): self
    {
        $this->socialNetworks = $socialNetwork;

        return $this;
    }
}
