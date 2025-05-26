<?php

namespace App\Entity;

use App\Repository\AuteurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; 

#[ORM\Entity(repositoryClass: AuteurRepository::class)]
class Auteur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]

    // Validation pour le nom
    #[Assert\NotBlank(message: 'Le nom ne peut pas être vide')]  
    #[Assert\Length( 
        min: 2, 
        max: 100, 
        minMessage: 'Le nom doit contenir au moins {{ limit }} caractères',  maxMessage: 'Le nom ne peut pas dépasser {{ limit }} caractères'
    )] 
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[ORM\Column(length: 100)]


    // Validation pour le prénom
    #[Assert\NotBlank(message: 'Le prénom ne peut pas être vide')]  
    #[Assert\Length( 
        min: 2, 
        max: 100, 
        minMessage: 'Le prénom doit contenir au moins {{ limit }} caractères',  maxMessage: 'Le prénom ne peut pas dépasser {{ limit }} caractères'  
    )] 
    private ?string $prenom = null;

    /**
     * @var Collection<int, Livre>
     */
    #[ORM\OneToMany(targetEntity: Livre::class, mappedBy: 'auteur')]
    private Collection $livres;

    public function __construct()
    {
        $this->livres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function getNomComplet(): ?string 
    {
        return $this->prenom.' '.$this->nom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * @return Collection<int, Livre>
     */
    public function getLivres(): Collection
    {
        return $this->livres;
    }

    public function addLivre(Livre $livre): static
    {
        if (!$this->livres->contains($livre)) {
            $this->livres->add($livre);
            $livre->setAuteur($this);
        }

        return $this;
    }

    public function removeLivre(Livre $livre): static
    {
        if ($this->livres->removeElement($livre)) {
            // set the owning side to null (unless already changed)
            if ($livre->getAuteur() === $this) {
                $livre->setAuteur(null);
            }
        }

        return $this;
    }
}
