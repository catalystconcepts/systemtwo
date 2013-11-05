<?php

namespace Dream89\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller{

    function indexAction()
    {
        return $this->render('Dream89AppBundle:home:index.html.twig');
    }
}