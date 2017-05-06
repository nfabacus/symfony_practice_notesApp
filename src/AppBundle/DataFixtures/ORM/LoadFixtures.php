<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Food; //Don't forget to add your entity here if you use it.
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nelmio\Alice\Fixtures;


class LoadFixtures implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        //example below
//        $food = new Food();
//        $food->setName('dish'.rand(1, 100));
//        $food->setCategory('Western food');
//        $food->setPopularityCount(rand(10, 300));
//        $food->setDescription('Delicious food...');  ////you need to make description nullable if you do not always enter the value.
//        $food->setIsPublished(true);
//        $food->setType('Cool type');
///
//        $manager->persist($food);  //make sure to put your variable inside () here.
//        $manager->flush();

        // Replace above with below to use alice.
        //Make sure to add on top, use Nelmio\Alice\Fixtures\Fixture;
//        Fixtures::load(__DIR__.'/fixtures.yml', $manager);

        //To create custom Alice Faker function, do below instead.
        Fixtures::load(
            __DIR__.'/fixtures.yml',
            $manager,
            [
                'providers' => [$this]
            ]
        );
    }

    //custom Alice faker Function..
    public function food()
    {
        $foodNames = [
            'Sushi',
            'Pizza',
            'Spaghetti',
            'Udon',
            'Baked Beans On Toast',
            'Roast Beef',
            'Sandwitch',
            'Sardine',
            'Salmon',
            'Fish and Chips'
        ];

        $key = array_rand($foodNames);

        return $foodNames[$key];
    }

    public function avatorFilename()
    {
        $avatorUrl = [
          'person1.jpg', 'person2.jpg', 'person3.jpg', 'person4.jpg'
        ];
        $key = array_rand($avatorUrl);

        return $avatorUrl[$key];
    }
}