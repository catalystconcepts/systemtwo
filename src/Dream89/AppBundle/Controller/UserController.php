<?php

namespace Dream89\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Dream89\AppBundle\Entity\User;
use Dream89\AppBundle\Form\UserType;

class UserController extends Controller {

    function registerAction()
    {
        $entity = new User();
        $form   = $this->createForm(new UserType(), $entity);

        return $this->render('Dream89AppBundle:user:register.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    function createAction()
    {
        // Process form and save new user
    }
}