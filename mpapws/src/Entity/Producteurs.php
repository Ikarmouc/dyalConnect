<?php

namespace App\Entity;

use App\Repository\ProducteursRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=ProducteursRepository::class)
 */
class Producteurs
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * Identifiant du producteur
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * Nom du producteur
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=50)
     * Prenom du producteur
     */
    private $prenom;

    /**
     * @ORM\Column(type="integer")
     * Numero de l'exploitation lié au producteur
     */
    private $exploitationId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getExploitationId(): ?int
    {
        return $this->exploitationId;
    }

    public function setExploitationId(int $exploitationId): self
    {
        $this->exploitationId = $exploitationId;

        return $this;
    }
}
