<?php
/**
 * Created by PhpStorm.
 * User: nobyfujioka
 * Date: 03/05/2017
 * Time: 14:31
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM; //You need to have this for every entity class you make - needed for mapping

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FoodRepository")
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
     * @ORM\Column(type="boolean")
     * Below $isPublished = true will make the default value true.
     */
    private $isPublished = true;

    /**
     * @ORM\Column(type="string")
     */
    private $type;

    /**
     * @ORM\Column(type="datetime")
     */
    private $publishedOn;

    //mappedBy is pointing the property "food" in FoodNote entity.
    //OrderBy the property descending order. Latest first.
    /**
     * @ORM\OneToMany(targetEntity="FoodNote", mappedBy="food")
     * @ORM\OrderBy({"CreatedAt"="DESC"})
     */
    private $notes;

    //Create this to access array of notes
    public function  __construct()
    {
        $this->notes = new ArrayCollection();
    }

    // This annotation is for auto-completion..
    /**
     * @return ArrayCollection|FoodNote[]
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * @return mixed
     */
    public function getIsPublished()
    {
        return $this->isPublished;
    }

    /**
     * @param mixed $isPublished
     */
    public function setIsPublished($isPublished)
    {
        $this->isPublished = $isPublished;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getPublishedOn()
    {
        return $this->publishedOn;
    }

    /**
     * @param mixed $publishedOn
     */
    public function setPublishedOn($publishedOn)
    {
        $this->publishedOn = $publishedOn;
    }


//nullable=true will allow user not to input anything.

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

    public function getUpdatedAt()
    {
        return new \DateTime('-'.rand(0,100).'days');
    }
    // $name is a private name property, so we need to create a getter and setter function.
    // Right click, Generate, Getters and Setters. Select $name. above { $this->name = $name } should be created.
    // See how to save/get the data using setName/getName in foodController.php.

    // When you add new columns, you need to do the following in the terminal.
    // bin/console doctrine:schema:update --force
    // BUT DON'T DO IT in Production!  It may erase data.
    // Use doctrine/doctrine-migration-bundle.
    // http://symfony.com/doc/current/bundles/DoctrineMigrationsBundle/index.html
    // If it is not installed, do composer require doctrine/doctrine-migrations-bundle
    // Make sure to add to the AppKernel.php
    // Now you can just do
    // bin/console doctrine:migrations:diff    to check.
    // bin/console doctrine:migrations:migrate


}

