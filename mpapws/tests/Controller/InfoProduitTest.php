<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class InfoProduitTest extends WebTestCase
{
    /**
     * Fonction de test de route
     */
    public function testRoute()
    {
        $client = static::createClient();

        $client->request("GET", "/exploitation/1/produits/1");

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    /**
     * Fonction de test affichage valeurs de la page
     */
    public function testInfosProduits()
    {
        $client = static::createClient();

        $client->request("GET", "/exploitation/1/produits/1");

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        // On teste
        $this->assertSelectorTextContains('html body div div h1', 'Fromage de chevre');

    }
}
