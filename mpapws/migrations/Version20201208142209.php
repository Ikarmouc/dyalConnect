<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201208142209 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Evenements DROP FOREIGN KEY Evenements_Producteur_id_fk');
        $this->addSql('ALTER TABLE Exploitation DROP FOREIGN KEY Exploitation_Producteur_id_fk');
        $this->addSql('CREATE TABLE evenement (id INT AUTO_INCREMENT NOT NULL, nom_evt VARCHAR(50) NOT NULL, id_producteur INT NOT NULL, detail_evt VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE producteurs (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, exploitation_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE Evenements');
        $this->addSql('DROP TABLE Producteur');
        $this->addSql('DROP INDEX Exploitation_Producteur_id_fk ON Exploitation');
        $this->addSql('ALTER TABLE Exploitation ADD id_exploitant VARCHAR(50) NOT NULL, DROP idExploitant, CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE nom nom VARCHAR(50) NOT NULL, CHANGE adresse adresse VARCHAR(50) NOT NULL, CHANGE details details VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE Produit DROP FOREIGN KEY Produit_Exploitation_id_fk');
        $this->addSql('DROP INDEX Produit_Exploitation_id_fk ON Produit');
        $this->addSql('ALTER TABLE Produit ADD id_exploitation INT NOT NULL, DROP idExploitation, DROP quantiteProduit, CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE nom nom VARCHAR(50) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Evenements (id INT NOT NULL, nomEvt VARCHAR(256) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, idProducteur INT DEFAULT NULL, detailEvt VARCHAR(256) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, INDEX Evenements_Producteur_id_fk (idProducteur), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE Producteur (id INT DEFAULT 1 NOT NULL, nom VARCHAR(256) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, prenom VARCHAR(256) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, exploitationId INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE Evenements ADD CONSTRAINT Evenements_Producteur_id_fk FOREIGN KEY (idProducteur) REFERENCES Producteur (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('DROP TABLE evenement');
        $this->addSql('DROP TABLE producteurs');
        $this->addSql('ALTER TABLE exploitation ADD idExploitant INT DEFAULT NULL, DROP id_exploitant, CHANGE id id INT NOT NULL, CHANGE nom nom VARCHAR(256) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, CHANGE adresse adresse VARCHAR(256) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, CHANGE details details VARCHAR(256) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`');
        $this->addSql('ALTER TABLE exploitation ADD CONSTRAINT Exploitation_Producteur_id_fk FOREIGN KEY (idExploitant) REFERENCES Producteur (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX Exploitation_Producteur_id_fk ON exploitation (idExploitant)');
        $this->addSql('ALTER TABLE produit ADD idExploitation INT DEFAULT NULL, ADD quantiteProduit INT DEFAULT NULL, DROP id_exploitation, CHANGE id id INT NOT NULL, CHANGE nom nom VARCHAR(256) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT Produit_Exploitation_id_fk FOREIGN KEY (idExploitation) REFERENCES Exploitation (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX Produit_Exploitation_id_fk ON produit (idExploitation)');
    }
}
