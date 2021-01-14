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
        for($i = 1; $i <= 1; $i++)
        {
            $producteurs = new Producteurs();
            $producteurs->setExploitationId($i);
            $producteurs->setNom("Dupres");
            $producteurs->setPrenom("Jean-marie");

            $exploitation = new Exploitation();
            $exploitation->setNom("La Prod' de Jean-mi");
            $exploitation->setAdresse("4 rue de la france 29000 Brest");
            $exploitation->setIdExploitant($i);
            $exploitation->setDetails("Une fromagerie de qualité 100% bretonne");

            $produit1 = new Produit();
            $produit1->setNom(" Fromage de chevre");
            $produit1->setIdExploitation($i);
            $produit1->setCategorie("Fromage");
            $produit1->setDescription("Un fromage de qualité fait de façon traditionelle");

            $produit2 = new Produit();
            $produit2->setNom("Reblochon");
            $produit2->setIdExploitation($i);
            $produit2->setCategorie("Fromage");
            $produit2->setDescription("Description du produit 2");

            $produit3 = new Produit();
            $produit3->setNom("La perle Noir");
            $produit3->setCategorie("Fromage");
            $produit3->setIdExploitation($i);
            $produit3->setDescription("un fromage doux et moelleux.");

            $entityManager->persist($produit1);
            $entityManager->persist($produit2);
            $entityManager->persist($produit3);


            $evenement1 = new Evenement();
            $evenement1->setNomEvt("Solde sur les fromages de chevres");
            $evenement1->setIdProducteur($i);
            $evenement1->setDetailEvt("-20% sur vos fromages de chevres du 10/12/2020 au 15/12/2019");
            $evenement1->setDateEvt("10/12/2020 - 15/12/2019");
            $evenement1->setHoraireEvt("14h00 - 17h00");

            $evenement2 = new Evenement();
            $evenement2->setNomEvt("Une perle noir acheté une offerte");
            $evenement2->setIdProducteur($i);
            $evenement2->setDetailEvt("Pour l'achat d'un fromage perle noir, un deuxieme est offert !");
            $evenement2->setDateEvt("31/01/2021");
            $evenement2->setHoraireEvt("14h00 - 17h00");

            $entityManager->persist($evenement1);
            $entityManager->persist($evenement2);

            $entityManager->persist($producteurs);
            $entityManager->persist($exploitation);
        }

        $entityManager->flush();
    }
}
