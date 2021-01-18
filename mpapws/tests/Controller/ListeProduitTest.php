<?php

namespace App\Tests\Controller;

use App\Entity\Exploitation;
use App\Entity\Image;
use App\Entity\Produit;
use Doctrine\Persistence\ObjectManager;
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
