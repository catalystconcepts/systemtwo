<?php

namespace Dream89\AppBundle\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserLoginTest extends WebTestCase
{
    public function testIsAtLoginPage()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Please sign in")')->count()
        );
    }
}