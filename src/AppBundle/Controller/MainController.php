<?php
/**
 * Created by PhpStorm.
 * User: nobyfujioka
 * Date: 03/05/2017
 * Time: 02:40
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class MainController extends Controller
{
    public function homepageAction()
    {
        return $this->render('main/homepage.html.twig');
    }
}