<?php

namespace Dream89\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
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

    function loginAction()
    {
        $session = new Session();
        $session->set('authenticated', true);

        return $this->render('Dream89AppBundle:user:login.html.twig');
    }

    function logoutAction()
    {
        $session = new Session();
        $session->set('authenticated', false);
        return $this->render('Dream89AppBundle:user:logout.html.twig');
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

            $this->get('session')->getFlashBag()->add(
                'success',
                'You are now a registered member of the site, you may login using your credentials.'
            );

            return $this->redirect($this->generateUrl('app_root'));
        }

        return $this->render('Dream89AppBundle:user:register.html.twig', array(
           'entity' => $entity,
            'form' => $form->createView(),
        ));
    }
}