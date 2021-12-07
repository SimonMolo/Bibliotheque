<?php

namespace App\Controller;

use App\Repository\AuthorRepository;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Book;
use Doctrine\ORM\EntityManagerInterface;

class BibliothequeController extends AbstractController
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
    // je Crée ma route pour ajouter un livre,
    // J'instancie la class Book pour creer un nouveau livre,
    // grace aux setteurs de "Book.php" je crée un title author nbPages et la date de parution,
    //je renvoie (pour le moment) un dump de ma variable livre que je viens de cree contenant les infos du livre
    /**
     * @Route("/livre/Create", name="livreCreate")
     */
    public function livreCreate(EntityManagerInterface $entityManager){

        $livre=New Book();
        $livre->setTitle("Plus fort que la haine");
        $livre->setAuthor("Tim Guénard");
        $livre->setNbPages("501");
        $livre->setDate(new \DateTime('1999-01-01'));

        $entityManager->persist($livre);
        $entityManager->flush();

        return $this->render("book_create.html.twig");
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