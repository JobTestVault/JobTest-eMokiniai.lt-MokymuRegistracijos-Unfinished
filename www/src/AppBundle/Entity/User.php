<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @ORM\HasLifecycleCallbacks
 */
class User extends BaseUser {   

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=100, nullable=true, unique=false)
     * 
     * @Assert\Length(
     *      min = 2,
     *      max = 100,
     *      minMessage = "Vardas turi turėti bent {{ limit }} simbolius",
     *      maxMessage = "Vardas turi būti ne trumpesnė nei {{ limit }} ženklų"
     * )
     */
    protected $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=100, nullable=true, unique=false)
     * 
     * @Assert\Length(
     *      min = 2,
     *      max = 100,
     *      minMessage = "Pavardė turi turėti bent {{ limit }} simbolius",
     *      maxMessage = "Pavardė turi būti ne trumpesnė nei {{ limit }} ženklų"
     * )
     */
    protected $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=20, nullable=true, unique=false)
     */
    protected $phone;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $created_at;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    protected $updated_at;

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return User
     */
    public function setFirstname($firstname) {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname() {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return User
     */
    public function setLastname($lastname) {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname() {
        return $this->lastname;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return User
     */
    public function setPhone($phone) {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone() {
        return $this->phone;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return User
     */
    public function setCreatedAt($createdAt) {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt() {
        return $this->created_at;
    }
    
    /**
     * Set updated at
     *
     * @param \DateTime $updatedat
     *
     * @return User
     */
    public function setUpdatedAt($updatedat) {
        $this->created_at = $updatedAt;

        return $this;
    }

    /**
     * Get updated at
     *
     * @return \DateTime
     */
    public function getUpdatedAt() {
        return $this->updated_at;
    }    

    /**
     * Updates timestamps on insert
     *
     * @ORM\PrePersist
     */
    public function updateOnInsert() {
        $this->setCreatedAt(new \DateTime('now'));
        $this->setUpdatedAt(new \DateTime('now'));
    }
    
    /**
     * Updates timestamps on update
     *
     * @ORM\PreUpdate
     */
    public function updateOnUpdate() {
        $this->setUpdatedAt(new \DateTime('now'));
    }

}
