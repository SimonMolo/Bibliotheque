<?php

namespace App\Controller;

use App\Repository\AuthorRepository;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class bibliothequeController extends AbstractController
{
// je nomme la route et indique ma route pour mon navigateur
    /**
     * @Route ("/", name="home")
     */
    public function home()
    {
        $books = [];
        $lastBooks = array_slice($books,-3, 3);
        return $this->render("home.html.twig", ['home'=> $lastBooks]);
    }
// meme procédé que au dessus pour la page livres
    /**
     * @Route ("/livres", name="livres")
     */
    // pour instancier la classe BookRepository
    // j'utilise l'autowire de Symfony
    // et je passe en parametres de la méthode de controleur
    // le nom de la classe "BookRepository" et une variables
    // dans laquelle je veux que symfony m'instancie la classe
    public function books(BookRepository $bookRepository)
    {
        // j'utilise la méthode findAll de la classe BookRepository
        // pour récupérer tous les livres de la table book
        $books = $bookRepository->findAll();

        return $this->render("livres.html.twig",['livres'=> $books]);
    }

    /**
     * @Route ("/livre/{id}", name="livre")
     */
    public function book($id, BookRepository $bookRepository)
    {
        $book = $bookRepository->find($id);

        return $this->render("livre.html.twig",['livre'=> $book]);
    }

}