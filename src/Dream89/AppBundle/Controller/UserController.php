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
        if($this->_checkSessionExists())
        {
            $this->get('session')->getFlashBag()->add(
                'info',
                'You are already registered.'
            );
            return $this->redirect($this->generateUrl('app_root'));
        }// redirect if logged in

        $entity = new User();
        $form   = $this->createForm(new UserType(), $entity);

        return $this->render('Dream89AppBundle:user:register.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    function loginAction()
    {
        if($this->_checkSessionExists())
        {
            $this->get('session')->getFlashBag()->add(
                'info',
                'You are already logged in.'
            );
            return $this->redirect($this->generateUrl('app_root'));
        }// redirect if logged in

        $show_signup = false;
        if($this->getRequest()->getMethod() === 'POST')
        {
            $user = $this->_checkCredentials();
            if($user)
            {
                $this->_createUserSession($user);
                $this->get('session')->getFlashBag()->add(
                    'success',
                    'You are now logged in!'
                );
                return $this->redirect($this->generateUrl('app_root'));
            }

            $show_signup = true;
            $this->get('session')->getFlashBag()->add(
                'danger',
                'Your entered username or password is incorrect.'
            );
        }
        return $this->render('Dream89AppBundle:user:login.html.twig', array(
            'show_signup' => $show_signup,
        ));
    }

    function logoutAction()
    {
        $this->get('session')->clear();
        $this->get('session')->getFlashBag()->add(
            'info',
            'You are now logged out!'
        );
        return $this->redirect($this->generateUrl('user_login'));
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
                'Congratz!!! You are now a member of the site, you may login using your credentials.'
            );

            return $this->redirect($this->generateUrl('app_root'));
        }

        return $this->render('Dream89AppBundle:user:register.html.twig', array(
           'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    private function _checkSessionExists()
    {
        $user = $this->get('session')->get('user');
        if($user)
        {
            return true;
        }
        return false;
    }

    private function _createUserSession($user)
    {
        $session = new Session();
        $session->set('user', $user);
    }

    private function _checkCredentials()
    {
        $username = $this->getRequest()->get('username');
        $password = $this->getRequest()->get('password');

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('Dream89AppBundle:User')->findOneBy(array('username'=>$username));

        if(!$user) // user not found
        {
            return false;
        }
        if(crypt($password, $user->getPassword()) !== $user->getPassword()) // password incorrect
        {
            return false;
        }
        return $user;
    }
}