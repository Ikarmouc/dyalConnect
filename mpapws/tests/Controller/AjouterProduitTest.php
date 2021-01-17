<?php

namespace App\Tests;

use App\Entity\Produit;
use Doctrine\Persistence\ObjectManager;
use PHPUnit\Framework\TestCase;

class AjouterProduitTest extends TestCase
{
    /**
     * Fonction de test de route pour la page Exploitation infos
     */
    public function testRoute()
    {
        $client = static::createClient();
        $client->request("GET", "/exploitation/1/produits/nouveau");
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    /**
     * Fonction test création Produit
     * On crée un produit
     */
    public function testAjoutProduit(ObjectManager $entityManager)
    {
        $client = static::createClient();
        $client->request("GET", "/exploitation/1/evenements");

        $produit = new Produit();
        $produit->setNom(" Fromage de chevre");
        $produit->setIdExploitation(1);
        $produit->setCategorie("Fromage");
        $produit->setDescription("Un fromage de qualité fait de façon traditionelle");
        $entityManager->persist($produit);
        $entityManager->flush();

        $this->assertEquals(1,$produit->getId());
    }
}
