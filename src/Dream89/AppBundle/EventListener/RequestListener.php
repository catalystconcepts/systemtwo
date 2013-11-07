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
        if ('user_login' === $event->getRequest()->get('_route'))
        {
            return;
        }
        if ('user_register' === $event->getRequest()->get('_route'))
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