<?php

namespace App\Tests\Controller;

use App\Entity\Exploitation;
use App\Entity\Produit;
use Doctrine\Persistence\ObjectManager;
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
    public function testInfosProduits(ObjectManager $entityManager)
    {
        $client = static::createClient();

        $client->request("GET", "/exploitation/1/produits/1");

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $exploitationTest = new Exploitation();
        $exploitationTest->setNom("NomTest");
        $exploitationTest->setAdresse("Adresse");
        $exploitationTest->setDetails("details");
        $exploitationTest->setIdExploitant(1);
        $entityManager->persist($exploitationTest);


        $produitTest = new Produit();
        $produitTest->setId(1);
        $produitTest->setIdExploitation(1);
        $produitTest->setNom("TEST");
        $produitTest->setCategorie("categorieTest");
        $produitTest->setDescription("TestDescription");

        $entityManager->persist($produitTest);
        $entityManager->flush();

        $this->assertSelectorTextContains('html body div div h1', 'TEST');

    }
}
