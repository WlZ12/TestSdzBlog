<?php

namespace Sdz\BlogBundle\Controller;

use Sdz\BlogBundle\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BlogController extends Controller
{
    public function indexAction($page)
    {
        if ($page < 1){
            throw $this->createNotFoundException("La page ".$page." est inexistante !");
        }

        //Les articles de test
        $articles = array(
            array(
                'titre' => 'Séjour au canada',
                'id' => 1,
                'auteur' => 'Adrien Viala',
                'contenu' => 'Le séjour été cool',
                'date' => new \DateTime()),
            array(
                'titre' => 'Séjour au blablabla',
                'id' => 1,
                'auteur' => 'Adrien Viala',
                'contenu' => 'Le séjour été cool',
                'date' => new \DateTime()),
            array(
                'titre' => 'Test',
                'id' => 1,
                'auteur' => 'Adrien Viala',
                'contenu' => 'Le séjour été cool',
                'date' => new \DateTime())
        );
        return $this->render("@SdzBlog/Blog/index.html.twig",
            array(
                'articles' => $articles
            ));
    }

    public function voirAction($id)
    {
        $repositoriy = $this->getDoctrine()->getManager()->getRepository('SdzBlogBundle:Article');
        $article = $repositoriy->find($id);
        if ($article === null)
        {
            throw $this->createNotFoundException('Article inexistant');
        }

        return $this->render('@SdzBlog/Blog/voir.html.twig',
            array(
                'article' => $article
            ));
    }

    public function ajouterAction()
    {
        $article =new Article();
        $article->setAuteur('Adrien');
        $article->setTitre('Sejour au Canada');
        $article->setContenu("C'était vraiment supre! et on s'est bien amusé");
        $em = $this->getDoctrine()->getManager();
        $em->persist($article);
        $em->flush();
        if ($this->getRequest()->getMethod() == 'POST'){
            $this->get('session')->getFlashBag()->add('info', 'Article enregitré !');
            return $this->redirect($this->generateUrl('sdzblog_voir', array('id'=>$article->getId())));
        }
        return $this->render('@SdzBlog/Blog/ajouter.html.twig');
    }

    public function modifierAction($id)
    {
        $article = array(
            'titre' => 'Séjour au canada',
            'id' => 1,
            'auteur' => 'Adrien Viala',
            'contenu' => 'Le séjour été cool',
            'date' => new \DateTime());
        return $this->render('@SdzBlog/Blog/modifier.html.twig', array(
            'article' => $article
        ));
    }

    public function supprimerAction($id)
    {
        return $this->render('@SdzBlog/Blog/supprimer.html.twig');
    }

    public function menuAction($nombre)
    {
        $liste = array(
            array('id' => 2, 'titre' => 'Mon dernier weekend !'),
            array('id' => 5, 'titre' => 'Symfony rule !'),
            array('id' => 9, 'titre' => 'Petit test !')
        );
        return $this->render("@SdzBlog/Blog/menu.html.twig",
            array(
                'liste_articles' => $liste
            ));
    }

}

