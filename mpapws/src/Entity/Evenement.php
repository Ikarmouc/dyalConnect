<?php

namespace App\Entity;

use App\Repository\EvenementRepository;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Integer;

/**
 * @ORM\Entity(repositoryClass=EvenementRepository::class)
 */
class Evenement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nomEvt;

    /**
     * @ORM\Column(type="integer")
     */
    private $idProducteur; //Correspond a l'id de la production

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $detailEvt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getNomEvt(): ?string
    {
        return $this->nomEvt;
    }

    public function setNomEvt(string $nomEvt): self
    {
        $this->nomEvt = $nomEvt;

        return $this;
    }

    public function getIdProducteur(): ?int
    {
        return $this->idProducteur;
    }

    public function setIdProducteur(int $idProducteur): self
    {
        $this->idProducteur = $idProducteur;

        return $this;
    }

    public function getDetailEvt(): ?string
    {
        return $this->detailEvt;
    }

    public function setDetailEvt(string $detailEvt): self
    {
        $this->detailEvt = $detailEvt;

        return $this;
    }
}
