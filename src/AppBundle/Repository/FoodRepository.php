<?php
//To create custom queries,
//    1. Create a folder called Repository.
//    2. Right click. Create PHP class. e.g. FoodRepository
//    3. Go to the file e.g. FoodRepository.php
//    4. extends it with EntityRepository.  e.g. class FoodRepository extends EntityRepository
//    5. Tell Doctrine to use this repository instead of EntityRepository.
//          In the entity, specify ORM|Entity(repositoryClass=" " like this,  * @ORM\Entity(repositoryClass="AppBundle\Repository\FoodRepository"
//          See how it is done in Food.php.
//    6. Use it in your controller. e.g. see foodController list action for an example.

/**
 * Created by PhpStorm.
 * User: nobyfujioka
 * Date: 04/05/2017
 * Time: 14:24
 */

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

class FoodRepository extends EntityRepository
{
    /**
     * @return Food[]
     * What is this instead of Mixed?  Because we know the data we are dealing with is Food entity..?
     */
    public function findAllPublishedOrderBySize()
    {
        return $this->createQueryBuilder('food')    //'food' here is just a alias for the Food table.
        ->andWhere('food.isPublished=:isPublished')  //specify the parameter
        ->setParameter('isPublished', true)  //we always set variable using parameter like this to avoid sql injection attack.
        ->orderBy('food.popularityCount', 'DESC')  // order by size of popularity
        ->getQuery()  //Finally get query.
        ->execute();  // This wil return an array of results. or use ->getOneOrNullResult() to return one result (or null)
    }
}