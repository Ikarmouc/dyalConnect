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
     * identifiant d'un evenement
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * nom d'un evenement
     */
    private $nomEvt;

    /**
     * @ORM\Column(type="integer")
     * identifiant du producteur assigné a l'evenement
     */
    private $idProducteur; //Correspond a l'id de la production

    /**
     * @ORM\Column(type="string", length=255)
     * Details d'un evenement
     */
    private $detailEvt;

    /**
     * @ORM\Column(type="string", length=50)
     * Date d'un evenement
     */
    private $dateEvt;

    /**
     * @ORM\Column(type="string", length=50)
     * horaire d'un evenement
     */
    private $horaireEvt;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * image associée a l'evenement
     */
    private $imageEvt;

    /**
     * @return int|null
     * fonction permettant de récuperer l'identifiant de l'evenement
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return $this
     * Assigne un identifiant a un evenement
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string|null
     * Permet de récuperer le nom d'un evenement
     */
    public function getNomEvt(): ?string
    {
        return $this->nomEvt;
    }

    /**
     * @param string $nomEvt
     * @return $this
     * Assigne un nom a un evenement
     */
    public function setNomEvt(string $nomEvt): self
    {
        $this->nomEvt = $nomEvt;

        return $this;
    }

    /**
     * @return int|null
     * Permet de récuperer l'identifiant du producteur lié a l'evenement
     */
    public function getIdProducteur(): ?int
    {
        return $this->idProducteur;
    }

    /**
     * @param int $idProducteur
     * @return $this
     * Permet d'assigner un identifiant producteur
     */
    public function setIdProducteur(int $idProducteur): self
    {
        $this->idProducteur = $idProducteur;

        return $this;
    }

    /**
     * @return string|null
     * Recupere les details d'un evenement
     */
    public function getDetailEvt(): ?string
    {
        return $this->detailEvt;
    }

    /**
     * @param string $detailEvt
     * @return $this
     * Assigne des details a un evenement
     */
    public function setDetailEvt(string $detailEvt): self
    {
        $this->detailEvt = $detailEvt;

        return $this;
    }

    /**
     * @return string|null
     * Recupere une date d'evenement
     */
    public function getDateEvt(): ?string
    {
        return $this->dateEvt;
    }

    /**
     * @param string $dateEvt
     * @return $this
     * Défini une date d'evenement
     */
    public function setDateEvt(string $dateEvt): self
    {
        $this->dateEvt = $dateEvt;

        return $this;
    }

    /**
     * @return string|null
     * On recupere les horaires de l'evenement
     */
    public function getHoraireEvt(): ?string
    {
        return $this->horaireEvt;
    }

    /**
     * @param string $horaireEvt
     * @return $this
     * Défini un horaire d'evenement
     */
    public function setHoraireEvt(string $horaireEvt): self
    {
        $this->horaireEvt = $horaireEvt;

        return $this;
    }

    /**
     * @return int|null
     * Récupere l'image lié a l'evenement
     */
    public function getImageEvt(): ?int
    {
        return $this->imageEvt;
    }

    /**
     * @param int|null $imageEvt
     * @return $this
     * Lie une image a un evenement
     */
    public function setImageEvt(?int $imageEvt): self
    {
        $this->imageEvt = $imageEvt;

        return $this;
    }
}
