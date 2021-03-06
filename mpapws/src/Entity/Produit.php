<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProduitRepository::class)
 */
class Produit
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * Identifiant d'un produit
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * Identifiant exploitation lié au produit
     */
    private $idExploitation;

    /**
     * @ORM\Column(type="string", length=50)
     * Nom du produit
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * Description du produit
     */
    private $description;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * Image principale du produit
     */
    private $mainImage;

    /**
     * @ORM\Column(type="string", length=50)
     * Categorie du produit
     */
    private $categorie;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getIdExploitation(): ?int
    {
        return $this->idExploitation;
    }

    public function setIdExploitation(int $idExploitation): self
    {
        $this->idExploitation = $idExploitation;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getMainImage(): ?int
    {
        return $this->mainImage;
    }

    public function setMainImage(?int $mainImage): self
    {
        $this->mainImage = $mainImage;

        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }
}
