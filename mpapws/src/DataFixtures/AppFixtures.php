<?php

namespace App\DataFixtures;

use App\Entity\Evenement;
use App\Entity\Exploitation;
use App\Entity\Image;
use App\Entity\Producteurs;
use App\Entity\Produit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $entityManager)
    {

            // Creation d'un producteur
            $producteurs = new Producteurs();
            $producteurs->setExploitationId($i);
            $producteurs->setNom("Dupres");
            $producteurs->setPrenom("Jean-marie");

            // Creation d'une exploitation
            $exploitation = new Exploitation();
            $exploitation->setNom("La Prod' de Jean-mi");
            $exploitation->setAdresse("4 rue de la france 29000 Brest");
            $exploitation->setIdExploitant($i);
            $exploitation->setDetails("Une fromagerie de qualité 100% bretonne");

            // Assignation d'une image pour le produit
            $image1 = new Image();
            $image1->setIdExploitation($i);
            $image1->setImageName("perleNoire.jpg");
            $entityManager->persist($image1);
            $entityManager->flush();

            // Creation d'un produit
            $produit1 = new Produit();
            $produit1->setNom("La perle Noir");
            $produit1->setCategorie("Fromage");
            $produit1->setIdExploitation($i);
            $produit1->setDescription("un fromage doux et moelleux.");
            $produit1->setMainImage($image1->getId());
            $entityManager->persist($produit1);

            // Assignation d'une image pour un evenement de l'exploitation
            $imageEvent1 = new Image();
            $imageEvent1->setIdExploitation($i);
            $imageEvent1->setImageName("perleNoire.jpg");
            $entityManager->persist($imageEvent1);
            $entityManager->flush();

            // Creation d'un evenement
            $evenement1 = new Evenement();
            $evenement1->setNomEvt("Solde sur les perles noire");
            $evenement1->setIdProducteur($i);
            $evenement1->setDetailEvt("-20% sur vos fromages du 10/12/2020 au 15/12/2019");
            $evenement1->setDateEvt("10/12/2020 - 15/12/2019");
            $evenement1->setHoraireEvt("14h00 - 17h00");
            $evenement1->setImageEvt($imageEvent1->getId());
            $entityManager->persist($evenement1);

            $entityManager->persist($producteurs);
            $entityManager->persist($exploitation);


        $entityManager->flush();
    }
}
