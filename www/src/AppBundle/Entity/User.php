<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @ORM\HasLifecycleCallbacks
 */
class User implements UserInterface {
    
    /**
     * User is in registered group
     */
    const GROUP_USER = 1;
    
    /**
     * User is in admin group
     */
    const GROUP_ADMIN = 2;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=100, nullable=true, unique=true)
     * 
     * @Assert\Length(
     *      min = 2,
     *      max = 100,
     *      minMessage = "Vardas turi turėti bent {{ limit }} simbolius",
     *      maxMessage = "Vardas turi būti ne trumpesnė nei {{ limit }} ženklų"
     * )
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=100, nullable=true, unique=true)
     * 
     * @Assert\Length(
     *      min = 2,
     *      max = 100,
     *      minMessage = "Pavardė turi turėti bent {{ limit }} simbolius",
     *      maxMessage = "Pavardė turi būti ne trumpesnė nei {{ limit }} ženklų"
     * )
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=true, unique=true)
     * 
     * @Assert\Email(
     *     message = "Adresas '{{ value }}' nėra tinkamas elektroninio pašto adresas!",
     *     checkMX = true
     * )
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=20, nullable=true, unique=true)
     */
    private $phone;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $created_at;

    /**
     * @var string
     * 
     * @ORM\Column(name="salt", type="string", length=40)
     */
    private $salt;

    /**
     * @var string 
     * 
     * @ORM\Column(name="password", type="string", length=40)
     */
    private $password;

    /**
     * @var int
     * 
     * @ORM\Column(name="group_id", type="smallint", nullable=false)
     */
    private $group_id;

    /**
     * Gets roles
     * 
     * @return array
     */
    public function getRoles() {
        switch ($this->group_id) {
            case self::GROUP_ADMIN:
                return ['ROLE_ADMIN'];
            case self::GROUP_USER:
                return ['ROLE_USER'];
            default:
                return [];
        }
    }
    
    /**
     * Get group
     * 
     * @return int
     */
    public function getGroup() {
        return $this->group_id;
    }
    
    /**
     * Set group
     * 
     * @param int $group
     * 
     * @return \AppBundle\Entity\User
     */
    public function setGroup($group) {
        $this->group_id = $group;
        
        return $this;
    }

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
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email) {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail() {
        return $this->email;
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
     * Generates and updates with new salt
     * 
     * @return string
     */
    public function generateNewSalt() {
        return $this->salt = md5(time());
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password) {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * Get's salt
     * 
     * @return string
     */
    public function getSalt() {
        return $this->salt;
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername() {
        return $this->email;
    }

    /**
     * Updates timestamps
     *
     * @ORM\PrePersist
     */
    public function updatedCreatedAt() {
        $this->setCreatedAt(new \DateTime('now'));
    }
    
    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials() {
        
    }    

}
