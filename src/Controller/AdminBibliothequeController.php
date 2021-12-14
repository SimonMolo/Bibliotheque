<?php

namespace App\Controller;

use App\Repository\AuthorRepository;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Book;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\BookType;
use Symfony\Component\HttpFoundation\Request;

class AdminBibliothequeController extends AbstractController
{
    /**
     * @Route("/admin/livre/create", name="admin_livreCreate")
     */
// j'instancie ma methode livreCreate
// dans les parametre, je dit que je veut placer la requette dans une variable requette
    public function livreCreate(Request $request,EntityManagerInterface $entityManager){

        // je crée un nouvel objet book
        $book = new book();
        //ca cree un formulaire en créant autant d'inputs que de collones dans mon tableau sql
        $bookForm = $this-> createForm(BookType::class, $book);
        // je recupere les valeurs de tous les inputs pour verifier si le formulaire est rempli et envoyé.
        $bookForm-> handleRequest($request);
        // si le formulaire est soumis et valide,
        if ($bookForm->isSubmitted() && $bookForm->isValid()){
            // j'envoie les données de la requette dans l'entitée book
            $entityManager->persist($book);
            // j'envoie l'entité book dans ma BDD
            $entityManager-> flush();
            return $this->redirectToRoute('admin_livres');
        }
        // j'envoie le resultat sur ma page dédiée
        return $this->render("admin/book_create.html.twig", [
            'bookForm' => $bookForm->createView()]);
    }

// meme procédé que au dessus pour la page livres
    /**
     * @Route ("/admin/livres", name="admin_livres")
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

        return $this->render("admin/livres.html.twig",['livres'=> $books]);
    }
    // je Crée ma route pour ajouter un livre,
    // J'instancie la class Book pour creer un nouveau livre,
    // grace aux setteurs de "Book.php" je crée un title author nbPages et la date de parution,
    //je renvoie (pour le moment) un dump de ma variable livre que je viens de cree contenant les infos du livre
    /**
     * @Route("/admin/livre/update/{id}", name="admin_livre_Update")
     */

    public function LivreUpdate($id, Request $request,BookRepository $bookRepository, EntityManagerInterface $entityManager){

            $book = $bookRepository->find($id);
            //ca cree un formulaire en créant autant d'inputs que de collones dans mon tableau sql
            $bookForm = $this-> createForm(BookType::class, $book);
            // je recupere les valeurs de tous les inputs pour verifier si le formulaire est rempli et envoyé.
            $bookForm-> handleRequest($request);
            // si le formulaire est soumis et valide,
            if ($bookForm->isSubmitted() && $bookForm->isValid()){
                // j'envoie les données de la requette dans l'entitée book
                $entityManager->persist($book);
                // j'envoie l'entité book dans ma BDD
                $entityManager-> flush();
                return $this->redirectToRoute('admin_livres');
            }
        return $this->render("admin/livre_uploaded.html.twig", [
            'bookForm' => $bookForm->createView()]);
        // j'envoie le resultat sur ma page dédiée
    }

    // j'indique ma route html
    /**
     * @Route("/admin/livre/delete/{id}", name="admin_livre_delete")
     */
    //j'instancie ma methode qui me servira a suprimer un livre de ma BDD
    public function livreDelete($id, BookRepository $bookRepository, EntityManagerInterface $entityManager){
       // dump('zé bartiii !'); die;
        // apres avoir testé ma route, je stock dans ma variable book le livre correspondant a l'id
        //demande dans l'url grace a une wild card (instanciée en parametres de ma route)
        $book = $bookRepository->find($id);
        $entityManager->remove($book);
        // je prépare mon livre a etre suprime de la BDD
        $entityManager->flush();
        // et je le supprime
        return $this->redirectToRoute("admin_livres");
        // je retourne le rendu sur ma page html.

    }


    /**
     * @Route ("/admin/livre/{id}", name="admin_livre")
     */

    //dans cette partie, je recupere l'ID dans l'URL.
    // je lui donne dans cette fonction les parametres (ce que je cheche dans le tableau; le nom de l'entité ou je cherche,
    // et la nom de la variable qui sera recuperée dans le page livre

    public function book($id, BookRepository $bookRepository)
    {
        //je stock le livre contenant l'id demandée dans une variable
        $book = $bookRepository->find($id);
// je return ce livre dans la page livre
        return $this->render("admin/livre.html.twig",['livre'=> $book]);
    }

    /**
     * @Route("/admin/search", name="admin_search_books")
     */
        public function searchBooks(BookRepository $bookReository, Request $request){
            // j'indique que $word est le resultat de la recherche de l'utilisateur dans l'URL
            $word = $request->query->get('query');
            //je stock le resultat de mon query dans la variable $books
            $books=$bookReository->searchByTitle($word);
            //je renvoie le resultat sur la page twig.
            return $this->render('admin/books_search.html.twig', [
                'books' => $books

            ]);
    }
}