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
    public function home(BookRepository $bookRepository)
    {
        // je cree une variable lastBooks qui va contenir les 3 derniers livres de ma BDD
        // pour cela j'appelle ma BDD, et lui dit de chercher dans la BDD les livres en prenant l'id des livre par ordre décroissant,
        // et selectionner les 3 derniers uniquement et je les renvoie dans ma page home ou les livres vont etre traités.
        $lastBooks = $bookRepository->findBy(array(),array('id'=>'DESC'),3,0);
        return $this->render("home.html.twig", ['lastBooks'=> $lastBooks]);
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

        // je les return dans ma page livres

        return $this->render("livres.html.twig",['livres'=> $books]);
    }

    /**
     * @Route ("/livre/{id}", name="livre")
     */

    //dans cette partie, je recupere l'ID dans l'URL.
    // je lui donne dans cette fonction les parametres (ce que je cheche dans le tableau; le nom de l'entité ou je cherche,
    // et la nom de la variable qui sera recuperée dans le page livre

    public function book($id, BookRepository $bookRepository)
    {
        //je stock le livre contenant l'id demandée dans une variable
        $book = $bookRepository->find($id);
// je return ce livre dans la page livre
        return $this->render("livre.html.twig",['livre'=> $book]);
    }

}