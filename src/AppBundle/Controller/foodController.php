<?php


namespace AppBundle\Controller;


use AppBundle\Entity\Food;
use AppBundle\Entity\FoodNote;
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
//             ->findAllPublishedOrderBySize();  //custom query ccreated with FoodRepository.php under Repository folder.

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

            $foodNote = new FoodNote();
            $foodNote->setUsername('Bob');
            $foodNote->setUserAvatorFilename('image/person1.jpg');
            $foodNote->setNote('This food is soo good! You should try it.');
            $foodNote->setCreatedAt(new \DateTime('-1month'));
            $foodNote->setFood($food);   //Pass the parent entity here.

            $em = $this->getDoctrine()->getManager();
            $em->persist($food);  //Don't forget to persist!
            $em->persist($foodNote);  //Don't forget to persist!
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

        //Find an item in table like this...
        $em = $this->getDoctrine()->getManager();
        $food = $em->getRepository('AppBundle:Food')
            ->findOneBy(['name' => $foodName]);

        if(!$food) {
            //If matching item is not found. Show this message... 404 page needs to be created.
            throw $this->createNotFoundException(('No food found.'));
        }

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
            'food' => $food,
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
            ['id' => 1, 'username' => 'John', 'avatorUri' => '/images/person1.jpg', 'note' => 'Nice food!'],
            ['id' => 2, 'username' => 'Isla', 'avatorUri' => '/images/person2.jpg', 'note' => 'Awesome dish'],
            ['id' => 3, 'username' => 'Bob', 'avatorUri' => '/images/person3.jpg', 'note' => 'I disagree.'],
            ['id' => 4, 'username' => 'Kate', 'avatorUri' => '/images/person1.jpg', 'note' => 'OK food..'],
            ['id' => 5, 'username' => 'Isla', 'avatorUri' => '/images/person2.jpg', 'note' => 'Yes'],
            ['id' => 6, 'username' => 'Oliver', 'avatorUri' => '/images/person4.jpg', 'note' => 'Salty']
        ];

        //label the whole array as notes
        $data = [
            'notes' => $notes
        ];

        //return json object
          return new JsonResponse($data);
    }
}