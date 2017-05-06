<?php
/**
 * Created by PhpStorm.
 * User: nobyfujioka
 * Date: 05/05/2017
 * Time: 23:26
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="food_note")
 */
class FoodNote
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $username;

    /**
     * @ORM\Column(type="string")
     */
    private $userAvatorFilename;

    /**
     * @ORM\Column(type="text")
     */
    private $note;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;


    /**
     * @ORM\ManyToOne(targetEntity="Food", inversedBy="notes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $food;

    /**
     * @return mixed
     */
    public function getFood()
    {
        return $this->food;
    }

    //Pass entire Food object - setFood(Food $food) as below.
    /**
     * @param mixed $food
     */
    public function setFood(Food $food)
    {
        $this->food = $food;
    }


    //Generate getter for id
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getUserAvatorFilename()
    {
        return $this->userAvatorFilename;
    }

    /**
     * @param mixed $userAvatorFilename
     */
    public function setUserAvatorFilename($userAvatorFilename)
    {
        $this->userAvatorFilename = $userAvatorFilename;
    }

    /**
     * @return mixed
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param mixed $note
     */
    public function setNote($note)
    {
        $this->note = $note;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }



}