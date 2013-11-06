<?php

namespace Dream89\AppBundle\Tests\Unit;

use Dream89\AppBundle\Entity\User;

class UserTest extends \PHPUnit_Framework_TestCase {

    function testCanCreateUser()
    {
        $user = new User();
        $this->assertInstanceOf('Dream89\AppBundle\Entity\User', $user);

        return $user;
    }

    /**
     * @depends testCanCreateUser
     * @param User $user
     */
    function testCanSetAttribs(User $user)
    {
        $data = array(
          'first_name' => 'Bob',
          'last_name' => 'Martin',
          'email' => 'bob@martin.com',
          'username' => 'bob_martin',
          'password' => 'bob123',
        );

        $user->setFirstName($data['first_name']);
        $user->setLastName($data['last_name']);
        $user->setEmail($data['email']);
        $user->setUsername($data['username']);
        $user->setPassword($data['password']);

        $this->assertEquals($data['first_name'], $user->getFirstName());
        $this->assertEquals($data['last_name'], $user->getLastName());
        $this->assertEquals($data['email'], $user->getEmail());
        $this->assertEquals($data['username'], $user->getUsername());
        $this->assertNotEquals($data['password'], $user->getPassword());
    }

    /**
     * @depends testCanCreateUser
     */
    function testCanMatchHashedPassword($user)
    {
        $plainPassword = 'mySecret';
        $differentPass = 'mySecret222';
        $user->setPassword($plainPassword);

        // @TODO below assertion should fail but it doesn't, need to fix this
        $this->assertEquals(crypt($differentPass, $user->getPassword()), $user->getPassword());
    }
}