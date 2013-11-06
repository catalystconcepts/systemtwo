<?php

namespace Dream89\AppBundle\Tests\Integration;

use Dream89\AppBundle\Tests\FunctionaltestCase;
use Dream89\AppBundle\Entity\User;

class UserTest extends FunctionaltestCase {

    function testCanSaveUser()
    {
        $user = new User();
        $user->setFirstName('John');
        $user->setLastName('Doe');
        $user->setEmail('john@doe.com');
        $user->setUsername('john123');
        $user->setPassword('pass123');

        $this->em->persist($user);
        $this->em->flush();

        $this->assertInstanceOf('Dream89\AppBundle\Entity\User', $user);
    }

    function testCanRetrieveUser()
    {
        $users = $this->em->getRepository('Dream89AppBundle:User')->findAll();
        $this->assertTrue(count($users) > 0);
    }
}