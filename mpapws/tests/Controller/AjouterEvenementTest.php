<?php

namespace App\Tests;

use App\Entity\Evenement;
use App\Entity\Exploitation;
use App\Entity\Producteurs;
use App\Entity\Produit;
use Doctrine\Persistence\ObjectManager;
use PHPUnit\Framework\TestCase;
use function mysql_xdevapi\expression;

class AjouterProduitTest extends TestCase
{
    /**
     * Fonction de test de route pour la page Exploitation infos
     */
    public function testRoute()
    {
        $client = static::createClient();
        $client->request("GET", "/exploitation/1/evenements/nouveau");
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    /**
     * Fonction test création Produit
     * On crée un produit
     */
    public function testAjoutEvenement(ObjectManager $entityManager)
    {

        $client = static::createClient();
        $client->request("GET", "/exploitation/1/evenements");


        $producteurs = new Producteurs();
        $producteurs->setExploitationId(1);
        $producteurs->setNom("Dupres");
        $producteurs->setPrenom("Jean-marie");

        $exploitation = new Exploitation();
        $exploitation->setNom("La Prod' de Jean-mi");
        $exploitation->setAdresse("4 rue de la france 29000 Brest");
        $exploitation->setIdExploitant(1);
        $exploitation->setDetails("Une fromagerie de qualité 100% bretonne");
        $entityManager->persist($exploitation);

        $evenement = new Evenement();
        $evenement->setNomEvt("NomTest");
        $evenement->setIdProducteur(1);
        $evenement->setDetailEvt("DetailsTest");
        $evenement->setDateEvt("12/12/2021");
        $evenement->setHoraireEvt("14h00 - 17h00");
        $entityManager->persist($evenement);

        $this->assertEquals("NomTest",$evenement->getNomEvt());
    }
}
