<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class InfoProduitTest extends WebTestCase
{
    public function testRoute()
    {
        $client = static::createClient();

        $client->request("GET", "/exploitation/1/produits/1");

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
