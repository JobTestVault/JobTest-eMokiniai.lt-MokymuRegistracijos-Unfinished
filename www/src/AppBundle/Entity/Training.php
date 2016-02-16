<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Training
 *
 * @ORM\Table(name="training")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TrainingRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Training
{
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
     * @ORM\Column(name="name", type="string", length=100, nullable=true, unique=true)
     * 
     * @Assert\Length(
     *      min = 2,
     *      max = 100,
     *      minMessage = "Pavadinimas turi turėti bent {{ limit }} simbolius",
     *      maxMessage = "Pavadinimas turi būti ne trumpesnė nei {{ limit }} ženklų"
     * )
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     * @Assert\Length(
     *      min = 10,
     *      max = 100,
     *      minMessage = "Aprašymas turi turėti bent {{ limit }} simbolius",
     *      maxMessage = "Aprašymas turi būti ne trumpesnė nei {{ limit }} ženklų"
     * )
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="places_count", type="integer")
     */
    private $places_count;

    /**
     * @var int
     *
     * @ORM\Column(name="places_left", type="integer")
     */
    private $places_left;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="starts_at", type="datetime")
     */
    private $starts_at;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $created_at;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Training
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Training
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set placesCount
     *
     * @param integer $placesCount
     *
     * @return Training
     */
    public function setPlacesCount($placesCount)
    {
        $this->places_count = $placesCount;

        return $this;
    }

    /**
     * Get placesCount
     *
     * @return int
     */
    public function getPlacesCount()
    {
        return $this->places_count;
    }

    /**
     * Set placesLeft
     *
     * @param integer $placesLeft
     *
     * @return Training
     */
    public function setPlacesLeft($placesLeft)
    {
        $this->places_left = $placesLeft;

        return $this;
    }

    /**
     * Get placesLeft
     *
     * @return int
     */
    public function getPlacesLeft()
    {
        return $this->places_left;
    }

    /**
     * Set startsAt
     *
     * @param \DateTime $startsAt
     *
     * @return Training
     */
    public function setStartsAt($startsAt)
    {
        $this->starts_at = $startsAt;

        return $this;
    }

    /**
     * Get startsAt
     *
     * @return \DateTime
     */
    public function getStartsAt()
    {
        return $this->starts_at;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Training
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }
    
    /**
     * Updates timestamps
     *
     * @ORM\PrePersist
     */
    public function updatedCreatedAt() {
        $this->setCreatedAt(new \DateTime('now'));
    }
}

