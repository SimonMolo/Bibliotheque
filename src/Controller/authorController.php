<?php

namespace App\Controller;

use App\Entity\Author;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AuthorRepository;

class authorController extends AbstractController
{
    /**
     * @Route("/auteurs", name="auteurs")
     */
    public function authors(authorRepository $authorRepository){

        $authors =$authorRepository->findAll();
        return $this->render("auteurs.html.twig", ['authors'=> $authors]);

    }
    /**
     *@Route("/auteur/create", name="auteur_create")
     */

    public function createAuthor(){
        //dump($author/create); die;
        $author=New author();
        $author-> setfirstName("Albert");
        $author-> setlastName("Camus");
        $author->setDeathDate(new \DateTime('1960-12-12'));
dump($author);die;
    }

    /**
     * @Route("/auteur/{id}", name="auteur")
     */
        public function auteurs($id, authorRepository $authorRepository){
        $author= $authorRepository->find($id);
        return $this->render('auteur.html.twig', ['author'=>$author]);
        }
}