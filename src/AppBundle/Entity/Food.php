<?php
/**
 * Created by PhpStorm.
 * User: nobyfujioka
 * Date: 03/05/2017
 * Time: 14:31
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM; //You need to have this for every entity class you make - needed for mapping

/**
 * @ORM\Entity
 * @ORM\Table(name="food")
 */
class Food
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
    private $name;

    /**
     * @ORM\Column(type="string")
     */
    private $category;

    /**
     * @ORM\Column(type="integer")
     */
    private $popularityCount;

    /**
     * @ORM\Column(type="string")
     */
    private $description;




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
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getPopularityCount()
    {
        return $this->popularityCount;
    }

    /**
     * @param mixed $popularityCount
     */
    public function setPopularityCount($popularityCount)
    {
        $this->popularityCount = $popularityCount;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
    // $name is a private name property, so we need to create a getter and setter function.
    // Right click, Generate, Getters and Setters. Select $name. above { $this->name = $name } should be created.
    // See how to save/get the data using setName/getName in foodController.php.

    // When you add new columns, you need to do the following in the terminal.
    // bin/console doctrine:schema:update --force
    // BUT DON'T DO IT in Production!  It may erase data.

}

