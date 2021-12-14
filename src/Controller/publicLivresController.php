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

class publicLivresController extends AbstractController
{
/**
 * @Route("/books", name="books")
 */
public function publicLivres(BookRepository $bookRepository){
        // je cree une variable lastBooks qui va contenir les 3 derniers livres de ma BDD
        // pour cela j'appelle ma BDD, et lui dit de chercher dans la BDD les livres en prenant l'id des livre par ordre décroissant,
        // et selectionner les 3 derniers uniquement et je les renvoie dans ma page home ou les livres vont etre traités.
        $livres = $bookRepository->findAll();
        return $this->render("public/books.html.twig", ['livres'=> $livres]);
    }
    /**
     * @Route("/public/book/{id}", name="book")
     */

    //dans cette partie, je recupere l'ID dans l'URL.
    // je lui donne dans cette fonction les parametres (ce que je cheche dans le tableau; le nom de l'entité ou je cherche,
    // et la nom de la variable qui sera recuperée dans le page livre

    public function book($id, BookRepository $bookRepository)
    {
        //je stock le livre contenant l'id demandée dans une variable
        $book = $bookRepository->find($id);
// je return ce livre dans la page livre
        return $this->render("public/book.html.twig",['livre'=> $book]);
    }

    /**
    * @Route("/search", name="search_books")
    */
    public function searchBooks(BookRepository $bookReository, Request $request){
        // j'indique que $word est le resultat de la recherche de l'utilisateur dans l'URL
        $word = $request->query->get('query');
        //je stock le resultat de mon query dans la variable $books
        $books=$bookReository->searchByTitle($word);
        //je renvoie le resultat sur la page twig.
        return $this->render('public/public_search.html.twig', [
            'books' => $books

        ]);
    }
}