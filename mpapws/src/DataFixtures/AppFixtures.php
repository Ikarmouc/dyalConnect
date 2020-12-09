<?php

namespace App\DataFixtures;

use App\Entity\Evenement;
use App\Entity\Exploitation;
use App\Entity\Producteurs;
use App\Entity\Produit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $entityManager)
    {
        for($i = 1; $i <= 3; $i++)
        {
            $producteurs = new Producteurs();
            $producteurs->setExploitationId($i);
            $producteurs->setNom("Nom Exploitant " . $i);
            $producteurs->setPrenom("Prenom Exploitant " . $i);

            $exploitation = new Exploitation();
            $exploitation->setNom("Exploitation du producteur " . $i);
            $exploitation->setAdresse("Adresse du producteur " . $i);
            $exploitation->setIdExploitant($i);
            $exploitation->setDetails("Détail de l'exploitation " . $i);

            $produit1 = new Produit();
            $produit1->setNom("Produit 1 - Exploitation " . $i);
            $produit1->setIdExploitation($i);
            $produit1->setDescription("Description du produit 1");

            $produit2 = new Produit();
            $produit2->setNom("Produit 2 - Exploitation " . $i);
            $produit2->setIdExploitation($i);
            $produit2->setDescription("Description du produit 2");

            $produit3 = new Produit();
            $produit3->setNom("Produit 3 - Exploitation " . $i);
            $produit3->setIdExploitation($i);
            $produit3->setDescription("Description du produit 3");

            $entityManager->persist($produit1);
            $entityManager->persist($produit2);
            $entityManager->persist($produit3);


            $evenement1 = new Evenement();
            $evenement1->setNomEvt("Evenement 1 - Exploitation " . $i);
            $evenement1->setIdProducteur($i);
            $evenement1->setDetailEvt("Description de l'evenement 1");

            $evenement2 = new Evenement();
            $evenement2->setNomEvt("Evenement 2 - Exploitation " . $i);
            $evenement2->setIdProducteur($i);
            $evenement2->setDetailEvt("Description de l'evenement 2");

            $entityManager->persist($evenement1);
            $entityManager->persist($evenement2);

            $entityManager->persist($producteurs);
            $entityManager->persist($exploitation);
        }

        $entityManager->flush();
    }
}
