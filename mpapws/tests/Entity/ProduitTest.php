<?php

namespace App\Tests\Controller;

use App\Entity\Exploitation;
use App\Entity\Produit;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Classe de test de la classe Exploitation
 */
class ProduitTest extends WebTestCase
{

    public function testIdProduit(ObjectManager $entityManager)
    {

        $produitTest = new Produit();
        $produitTest->setIdExploitation(1);
        $produitTest->setNom("Nom");
        $produitTest->setDescription("Description");
        $produitTest->setCategorie("Categorie");
        $entityManager->persist($produitTest);
        $entityManager->flush();

        $this->assertEquals(1,$produitTest->getId());
    }

    public function testIdExploitationProduit(ObjectManager $entityManager)
    {

        $produitTest = new Produit();
        $produitTest->setIdExploitation(1);
        $produitTest->setNom("Nom");
        $produitTest->setDescription("Description");
        $produitTest->setCategorie("Categorie");
        $entityManager->persist($produitTest);
        $entityManager->flush();

        $this->assertEquals(1,$produitTest->getIdExploitation());
    }
    public function testNomProduit(ObjectManager $entityManager)
    {

        $produitTest = new Produit();
        $produitTest->setIdExploitation(1);
        $produitTest->setNom("Nom");
        $produitTest->setDescription("Description");
        $produitTest->setCategorie("Categorie");
        $entityManager->persist($produitTest);
        $entityManager->flush();

        $this->assertEquals("Nom",$produitTest->getNom());
    }

    public function testDescriptionProduit(ObjectManager $entityManager)
    {

        $produitTest = new Produit();
        $produitTest->setIdExploitation(1);
        $produitTest->setNom("Nom");
        $produitTest->setDescription("Description");
        $produitTest->setCategorie("Categorie");
        $entityManager->persist($produitTest);
        $entityManager->flush();

        $this->assertEquals("Description",$produitTest->getDescription());
    }
    public function testCategorieProduit(ObjectManager $entityManager)
    {

        $produitTest = new Produit();
        $produitTest->setIdExploitation(1);
        $produitTest->setNom("Nom");
        $produitTest->setDescription("Description");
        $produitTest->setCategorie("Categorie");
        $entityManager->persist($produitTest);
        $entityManager->flush();

        $this->assertEquals("Categorie",$produitTest->getCategorie());
    }

}