<?php

namespace Sdz\BlogBundle\Controller;

use Sdz\BlogBundle\Entity\Article;
use Sdz\BlogBundle\Entity\Image;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BlogController extends Controller
{
    public function indexAction($page)
    {
        if ($page < 1){
            throw $this->createNotFoundException("La page ".$page." est inexistante !");
        }

        //Les articles de test
//        $articles = array(
////            array(
////                'titre' => 'Séjour au canada',
////                'id' => 1,
////                'auteur' => 'Adrien Viala',
////                'contenu' => 'Le séjour été cool',
////                'date' => new \DateTime()),
////            array(
////                'titre' => 'Séjour au blablabla',
////                'id' => 1,
////                'auteur' => 'Adrien Viala',
////                'contenu' => 'Le séjour été cool',
////                'date' => new \DateTime()),
////            array(
////                'titre' => 'Test',
////                'id' => 1,
////                'auteur' => 'Adrien Viala',
////                'contenu' => 'Le séjour été cool',
////                'date' => new \DateTime())
////        );
        $articles = $this->getDoctrine()->getManager()->getRepository('SdzBlogBundle:Article')->myFindOne(1);

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
        $image = new Image();
        $image->setUrl("https://www.google.fr/imgres?imgurl=https%3A%2F%2Fimg1.bonnesimages.com%2Fbi%2Fpaques%2Fpaques_025.jpg&imgrefurl=https%3A%2F%2Fwww.bonnesimages.com%2Fimage%2F7420&docid=aPrjCFk-RP-XMM&tbnid=0fEBkxv0a36h6M%3A&vet=10ahUKEwi8tc-a_5vaAhWFKlAKHSgKDisQMwgwKAAwAA..i&w=960&h=409&client=opera&bih=943&biw=1880&q=image%20de%20paques&ved=0ahUKEwi8tc-a_5vaAhWFKlAKHSgKDisQMwgwKAAwAA&iact=mrc&uact=8");
        $image->setAlt("Image de paques avec un nom beaucoup trop long");
        $article->setImage($image);
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

