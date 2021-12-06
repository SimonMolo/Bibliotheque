<?php

namespace App\Controller;

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
     * @Route("/auteur/{id}", name="auteur")
     */
    public function auteurs($id, authorRepository $authorRepository){
    $author= $authorRepository->find($id);
    return $this->render('auteur.html.twig', ['author'=>$author]);
    }
}