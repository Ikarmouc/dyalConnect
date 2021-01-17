<?php

namespace App\Tests;

use App\Entity\Evenement;
use App\Entity\Exploitation;
use App\Entity\Producteurs;
use App\Entity\Produit;
use PHPUnit\Framework\TestCase;

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
    public function testAjoutEvenement()
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

        $evenement = new Evenement();
        $evenement->setNomEvt("Solde sur les fromages de chevres");
        $evenement->setIdProducteur(1);
        $evenement->setDetailEvt("-20% sur vos fromages de chevres du 10/12/2020 au 15/12/2019");
        $evenement->setDateEvt("10/12/2020 - 15/12/2019");
        $evenement->setHoraireEvt("14h00 - 17h00");

        $this->assertEquals("Solde sur les fromages de chevres",$evenement->getNomEvt());
    }
}
