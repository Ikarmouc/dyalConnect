<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ImageRepository::class)
 */
class Image
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * Identifiant d'une image
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * Identifiant exploitation liée
     */
    private $idExploitation;

    /**
     * @ORM\Column(type="string", length=255)
     * Nom de l'image
     */
    private $imageName;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(string $imageName): self
    {
        $this->imageName = $imageName;

        return $this;
    }
}
