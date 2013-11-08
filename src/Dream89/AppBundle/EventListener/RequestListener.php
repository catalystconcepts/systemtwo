<?php

namespace Dream89\AppBundle\EventListener;

use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;

class RequestListener {

    private $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        if (HttpKernel::MASTER_REQUEST != $event->getRequestType()) {
            // don't do anything if it's not the master request
            return;
        }
        $session = $this->container->get('session');
        $router = $this->container->get('router');

        /* public access */
        $public_routes = array('user_login', 'user_register', 'user_create');

        if (in_array($event->getRequest()->get('_route'), $public_routes))
        {
            return;
        }
        /* end public access */

        // if authenticated and has user session
        if($session->get('user'))
        {
            return;
        }
        else { // not authenticated
            $event->setResponse(new RedirectResponse($router->generate('user_login')));
            return;
        }
    }
}