<?php

namespace Dream89\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller {

    function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('Dream89AppBundle:User')->findAll();

        return $this->render('Dream89AppBundle:home:index.html.twig', array(
            'users' => $users,
        ));
    }
}