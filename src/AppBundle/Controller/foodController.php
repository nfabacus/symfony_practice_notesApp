<?php


namespace AppBundle\Controller;


use AppBundle\Entity\Food;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;


class foodController extends Controller
{

    /**
     * @Route("/food")
     */
    public function showAction()
    {
        return new Response('Hello, World!');
    }

    /**
     * @Route("/food/new")
     */
    public function newAction(){
        $food = new Food();
        $food->setName('Sundae'.rand(1, 100));

        //$em is entity manager.
        $em = $this->getDoctrine()->getManager();
        $em->persist($food); //This tells doctrine that I want to save this.
        $em->flush(); //This will run the query.

        return new Response('<html><body>Food created!</body></html>');
    }

    /**
     * @Route("/food/{foodName}")
     */
    public function showOneAction($foodName)
    {
//        $templating = $this->container->get('templating');
//        $html = $templating->render('food/showOne.html.twig', [
//            'name' => $foodName
//        ]);
//        return new Response($html);

        $myMarkdown = '*Sushi*';
        $myMarkdown = $this->get('markdown.parser')->transform($myMarkdown);

        $foodList = [
            $myMarkdown,
            'Orange',
            'Strawberry cake',
            'Carrot',
            'Yakitori'
        ];

        // You can pass strings, array to twig like below.
        return $this->render('food/showOne.html.twig', [
            'name' => $foodName,
            'foodList' => $foodList
        ]);
    }


    /**
     * @Route("/food/{foodName}/notes", name="food_show_notes")
     * @Method("GET")
     */
    public function getNotesAction()
    {

        $notes = [
            ['id' => 1, 'username' => 'John', 'avatorUri' => '/images/person1.jpg', 'notes' => 'Nice food!'],
            ['id' => 2, 'username' => 'Isla', 'avatorUri' => '/images/person2.jpg', 'notes' => 'Awesome dish'],
            ['id' => 3, 'username' => 'Bob', 'avatorUri' => '/images/person3.jpg', 'notes' => 'I disagree.'],
            ['id' => 4, 'username' => 'Kate', 'avatorUri' => '/images/person1.jpg', 'notes' => 'OK food..'],
            ['id' => 5, 'username' => 'Oliver', 'avatorUri' => '/images/person2.jpg', 'notes' => 'Yes'],
            ['id' => 6, 'username' => 'Isla', 'avatorUri' => '/images/person4.jpg', 'notes' => 'Salty']
        ];

        //label the whole array as notes
        $data = [
            'notes' => $notes
        ];

        //return json object
          return new JsonResponse($data);
    }
}