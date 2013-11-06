<?php

namespace Dream89\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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

    function createAction(Request $request)
    {
        $entity = new User();
        $form = $this->createForm(new UserType(), $entity);

        $form->handleRequest($request);

        if($form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('app_root'));
        }

        return $this->render('Dream89AppBundle:User:register.html.twig', array(
           'entity' => $entity,
            'form' => $form->createView(),
        ));
    }
}