<?php

namespace App\DataFixtures;

use App\Entity\Auteur;
use App\Entity\Livre;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Créer des auteurs 
        $auteur1 = new Auteur(); 
        $auteur1->setNom('Hugo'); 
        $auteur1->setPrenom('Victor'); 
        $manager->persist($auteur1); // je met en cache

        $auteur2 = new Auteur(); 
        $auteur2->setNom('Camus'); 
        $auteur2->setPrenom('Albert'); 
        $manager->persist($auteur2); // je met en cache

        // Créer des livres 
        $livre1 = new Livre(); 
        $livre1->setTitre('Les Misérables');  $livre1->setAnnee(1862); 
        $livre1->setAuteur($auteur1); 
        $manager->persist($livre1);

        $livre2 = new Livre(); 
        $livre2->setTitre('Notre-Dame de Paris'); 
        $livre2->setAnnee(1831); 
        $livre2->setAuteur($auteur1); 
        $manager->persist($livre2); 

        $livre3 = new Livre(); 
        $livre3->setTitre('L\'Étranger'); 
        $livre3->setAnnee(1942); 
        $livre3->setAuteur($auteur2); 
        $manager->persist($livre3); 

        $livre4 = new Livre(); 
        $livre4->setTitre('La Peste'); 
        $livre4->setAnnee(1947); 
        $livre4->setAuteur($auteur2); 
        $manager->persist($livre4); 


        $manager->flush();
    }
}
