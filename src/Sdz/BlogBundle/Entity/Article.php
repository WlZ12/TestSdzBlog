<?php

namespace Sdz\BlogBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Sdz\BlogBundle\Entity\Categorie;
use Sdz\BlogBundle\Entity\Commentaire;

/**
 * Article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity(repositoryClass="Sdz\BlogBundle\Repository\ArticleRepository")
 */
class Article
{
    /**
     * @ORM\OneToOne(targetEntity="Sdz\BlogBundle\Entity\Image",cascade={"persist"})
     */
    private $image;

    /**
     * @ORM\ManyToMany(targetEntity="Sdz\BlogBundle\Entity\Categorie",cascade={"persist"})
     */

    private $categories;

    /**
     * @ORM\OneToMany(targetEntity="Sdz\BlogBundle\Entity\Commentaire", mappedBy="article")
     */
    private $commentaires;
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var \Boolean
     *
     * @ORM\Column(name="publication", type="boolean")
     */
    private $publication;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="auteur", type="string", length=255)
     */
    private $auteur;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text")
     */
    private $contenu;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->date = new \DateTime();
        $this->publication = true;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Article
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set titre
     *
     * @param string $titre
     * @return Article
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set auteur
     *
     * @param string $auteur
     * @return Article
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * Get auteur
     *
     * @return string 
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     * @return Article
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string 
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set publication
     *
     * @param boolean $publication
     * @return Article
     */
    public function setPublication($publication)
    {
        $this->publication = $publication;

        return $this;
    }

    /**
     * Get publication
     *
     * @return boolean 
     */
    public function getPublication()
    {
        return $this->publication;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage(Image $image = null): void
    {
        $this->image = $image;
    }

    /**
     * Remove la catégorie en parametre de la liste
     * @param Categorie $categorie
     */
    public function removeCategorie (Categorie $categorie)
    {
        $this->categories->remove($categorie);
    }

    /**
     * Ajoute une catégorie à la liste
     * @param Categorie $categorie
     */
    public function addCategorie(Categorie $categorie)
    {
        $this->categories->add($categorie);
    }

    /**
     *  Get the value of categorie
     * @return ArrayCollection
     */
    public function getCategories ()
    {
        return $this->categories;
    }

    /**
     * Add categories
     *
     * @param Categorie $categories
     * @return Article
     */
    public function addCategory(Categorie $categories)
    {
        $this->categories[] = $categories;

        return $this;
    }

    /**
     * Remove categories
     *
     * @param Categorie $categories
     */
    public function removeCategory(Categorie $categories)
    {
        $this->categories->removeElement($categories);
    }

    /**
     * Add commentaires
     *
     * @param Commentaire $commentaires
     * @return Article
     */
    public function addCommentaire(Commentaire $commentaires)
    {
        $this->commentaires[] = $commentaires;
        $commentaires->setArticle($this);
        return $this;
    }

    /**
     * Remove commentaires
     *
     * @param Commentaire $commentaires
     */
    public function removeCommentaire(Commentaire $commentaires)
    {
        $this->commentaires->removeElement($commentaires);
    }

    /**
     * Get commentaires
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }
}
