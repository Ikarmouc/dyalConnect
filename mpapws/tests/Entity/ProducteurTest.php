<?php

namespace App\Tests\Controller;

use App\Entity\Producteurs;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProducteurTest extends WebTestCase
{
    public function testIdProducteur()
    {
        $producteurs = new Producteurs();
        $producteurs->setExploitationId(1);
        $producteurs->setNom("Nom");
        $producteurs->setPrenom("Prenom");

        $this->assertEquals(1,$producteurs->getId());
    }
    public function testIdExploitationProducteur()
    {
        $producteurs = new Producteurs();
        $producteurs->setExploitationId(1);
        $producteurs->setNom("Nom");
        $producteurs->setPrenom("Prenom");

        $this->assertEquals(1,$producteurs->getExploitationId());
    }
    public function testNomProducteur()
    {
        $producteurs = new Producteurs();
        $producteurs->setExploitationId(1);
        $producteurs->setNom("Nom");
        $producteurs->setPrenom("Prenom");

        $this->assertEquals("Nom",$producteurs->getNom());
    }
    public function testPrenomProducteur()
    {
        $producteurs = new Producteurs();
        $producteurs->setExploitationId(1);
        $producteurs->setNom("Nom");
        $producteurs->setPrenom("Prenom");

        $this->assertEquals("Prenom",$producteurs->getPrenom());
    }


}