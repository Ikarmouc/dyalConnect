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
    public function testNomProduit(ObjectManager $entityManager)
    {
        $client = static::createClient();
        $client->request("GET", "/exploitation/1/produits");
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

        $this->assertEquals("TEST",$produitTest->getNom());
    }

    public function testIdExploitationProduit(ObjectManager $entityManager)
    {
        $client = static::createClient();
        $client->request("GET", "/exploitation/1/produits");
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

        $this->assertEquals(1,$produitTest->getIdExploitation());
    }

    public function testIdProduit(ObjectManager $entityManager)
    {
        $client = static::createClient();
        $client->request("GET", "/exploitation/1/produits");
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

        $this->assertEquals(1,$produitTest->getId());
    }

    public function testDetailsProduit(ObjectManager $entityManager)
    {
        $client = static::createClient();
        $client->request("GET", "/exploitation/1/produits");
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

        $this->assertEquals("TestDescription",$produitTest->getDescription());
    }

    public function testImagePrincipaleProduit(ObjectManager $entityManager)
    {
        $client = static::createClient();
        $client->request("GET", "/exploitation/1/produits");
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $exploitationTest = new Exploitation();
        $exploitationTest->setNom("NomTest");
        $exploitationTest->setAdresse("Adresse");
        $exploitationTest->setDetails("details");
        $exploitationTest->setIdExploitant(1);
        $entityManager->persist($exploitationTest);

        $image = new Image();
        $image->setIdExploitation(1);
        $image->setImageName("perleNoire.jpg");
        $entityManager->persist($image);
        $entityManager->flush();

        $produitTest = new Produit();
        $produitTest->setId(1);
        $produitTest->setIdExploitation(1);
        $produitTest->setNom("TEST");
        $produitTest->setCategorie("categorieTest");
        $produitTest->setDescription("TestDescription");
        $produitTest->setMainImage(1);
        $entityManager->persist($produitTest);
        $entityManager->flush();

        $this->assertEquals(1,$produitTest->getMainImage());
    }
}
