<?php
namespace Sdz\BlogBundle\DataFixtures\ORM;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Sdz\BlogBundle\Entity\Competence;

class Competences implements FixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $noms = array('Doctrine', 'Formulaire', 'Twig');
        foreach ($noms as $i =>$nom){
            $liste_competence[$i] = new Competence();
            $liste_competence[$i]->setNom($nom);
            $manager->persist($liste_competence[$i]);
        }
        $manager->flush();
    }
}