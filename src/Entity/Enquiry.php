<?php
namespace App\Entity;


use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity(repositoryClass="App\Repository\UserFeedBackRepository")
 * @ORM\Table(name="user_feedback")
 */
class Enquiry
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private  $id;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('name', new NotBlank());
        $metadata->addPropertyConstraint('email', new Email());
        $metadata->addPropertyConstraint('subject',  new Length(array(
            'max'        => 50

        )));
        $metadata->addPropertyConstraint('body', new Length(array(
            'min'        => 50
        )));
    }

    /**
     * @ORM\Column(type="string")
     */private $name;

    /**
     * @ORM\Column(type="string")
     */private $email;

    /**
     * @ORM\Column(type="string")
     */private $subject;

    /**
     * @ORM\Column(type="string")
     */private $body;

    public function getId()
    {
        return $this->id;
    }


    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param mixed $subject
     */
    public function setSubject($subject): void
    {
        $this->subject = $subject;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param mixed $body
     */
    public function setBody($body): void
    {
        $this->body = $body;
    }
    /**
     * @return mixed
     */

}


