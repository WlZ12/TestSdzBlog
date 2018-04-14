<?php
namespace Sdz\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Sdz\BlogBundle\Entity\Categorie;

class Categories implements FixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $noms = array('Symfony2', 'Doctrine2', 'Tutoriel', 'Evenement');
        foreach ($noms as $i =>$nom){
            $liste_categorie[$i] = new Categorie ();
            $liste_categorie[$i]->setNom($nom);
            $manager->persist($liste_categorie[$i]);
        }
        $manager->flush();
    }
}