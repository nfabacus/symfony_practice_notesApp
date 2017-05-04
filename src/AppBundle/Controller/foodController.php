<?php


namespace AppBundle\Controller;


use AppBundle\Entity\Food;
use AppBundle\Form\FoodFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;


class foodController extends Controller
{



    /**
     * @Route("/food", name="show_list")
     */
    public function listAction()
    {
       $em = $this->getDoctrine()->getManager();
       $foodList = $em->getRepository('AppBundle:Food')  //or 'AppBundle\Entity\Food' - the same thing for getting the entity.
           ->findAll();

       return $this->render('food/list.html.twig', [
           'foodList' => $foodList
       ]);
    }

    /**
     * @Route("/food/new", name="food_new")
     */
    public function newAction(Request $request){     //This single action method is responsible for both rendering the form and processing inputs.

        $form = $this->createForm(FoodFormType::class);  //Make sure to add use statement for the FoodFormType on the top.

        $form->handleRequest($request);  //This handles data only on POST.

        if ($form->isSubmitted() && $form->isValid()) {
            $food = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($food);
            $em->flush();

            $this->addFlash('success', 'Food added - Excellent!');  //You can set flash message with the key 'success'.
            //Then, you can add the message anywhere in twig templates.  base.html.twig may be a good place.

            return $this->redirectToRoute('show_list');  //redirect to the list view (name) url.
        }

        return $this->render('food/new.html.twig', [  //add twig template for the form.
            'foodForm' => $form->createView()   //pass the form as a variable 'foodForm' to the twig template here.
        ]);

//        Make sure to make the template

//        $food = new Food();
//        $food->setName('Sundae'.rand(1, 100));
//        $food->setCategory('Western food');
//        $food->setPopularityCount(rand(10, 300));
////        $food->setDescription('Delicious food...');  ////you need to make description nullable if you do not always enter the value.
//
//        //$em is entity manager.
//        $em = $this->getDoctrine()->getManager();
//        $em->persist($food); //This tells doctrine that I want to save this.
//        $em->flush(); //This will run the query.
//
//        return new Response('<html><body>Food created!</body></html>');
    }



    /**
     * @Route("/food/{foodName}", name="food_show")
     */
    public function showAction($foodName)
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