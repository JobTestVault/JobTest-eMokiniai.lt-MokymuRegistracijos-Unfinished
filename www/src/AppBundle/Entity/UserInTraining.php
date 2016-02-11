<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\User;
use AppBundle\Entity\Training;

/**
 * UserInTraining
 *
 * @ORM\Table(name="user_in_training")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserInTrainingRepository")
 */
class UserInTraining {

    /**
     * @var User
     * 
     * @ORM\OneToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;
    
    /**
     * @var Training
     * 
     * @ORM\OneToOne(targetEntity="Training")
     * @ORM\JoinColumn(name="training_id", referencedColumnName="id")
     */
    private $training;    

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(name="user_id", type="integer")
     */
    private $user_id;

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(name="training_id", type="integer")
     */
    private $training_id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="registered_date", type="datetime")
     */
    private $registered_date;

    /**
     * Get registered date
     *
     * @return \DateTime
     */
    public function getRegisteredDate() {
        return $this->registered_date;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return UserInTraining
     */
    public function setUserId($userId) {
        $this->user_id = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return int
     */
    public function getUserId() {
        return $this->user_id;
    }

    /**
     * Set trainingId
     *
     * @param integer $trainingId
     *
     * @return UserInTraining
     */
    public function setTrainingId($trainingId) {
        $this->training_id = $trainingId;

        return $this;
    }

    /**
     * Get trainingId
     *
     * @return int
     */
    public function getTrainingId() {
        return $this->training_id;
    }

}
