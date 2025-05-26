<?php

namespace App\Entity;

use App\Repository\LivreRepository;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: LivreRepository::class)]
class Livre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]


    // Validation pour titre
    #[Assert\NotBlank(message: 'Le titre ne peut pas être vide')]  
    #[Assert\Length( 
        min: 1, 
        max: 255, 
        minMessage: 'Le titre doit contenir au moins {{ limit }} caractère',  maxMessage: 'Le titre ne peut pas dépasser {{ limit }} caractères'  
    )]

    private ?string $titre = null;

    #[ORM\Column]

    // Validation pour l'année
    #[Assert\NotBlank(message: 'L\'année ne peut pas être vide')]  
    #[Assert\Type( 
        type: 'integer', 
        message: 'L\'année doit être un nombre entier' 
    )]
    #[Assert\Range( 
        min: 1000, 
        max: 2030, 
        notInRangeMessage: 'L\'année doit être entre {{ min }} et {{ max }}'  
    )]
    private ?int $annee = null;

    #[ORM\ManyToOne(inversedBy: 'livres')]
    private ?Auteur $auteur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getAnnee(): ?int
    {
        return $this->annee;
    }

    public function setAnnee(int $annee): static
    {
        $this->annee = $annee;

        return $this;
    }

    public function getAuteur(): ?Auteur
    {
        return $this->auteur;
    }

    public function setAuteur(?Auteur $auteur): static
    {
        $this->auteur = $auteur;

        return $this;
    }
}
