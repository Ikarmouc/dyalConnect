<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ListeProduitTest extends WebTestCase
{
    public function testRoute()
    {
        $client = static::createClient();

        $client->request("GET", "/exploitation/1/produits");

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
