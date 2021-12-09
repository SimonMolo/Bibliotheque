<?php

namespace App\Controller;

use App\Repository\AuthorRepository;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Book;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\BookType;

class AdminBibliothequeController extends AbstractController
{
    /**
     * @Route("/admin/livre/create", name="admin_livreCreate")
     */
// j'instancie ma methode livreCreate
    public function livreCreate(EntityManagerInterface $entityManager){

        // je crée un nouvel objet book
        $book = new book();
        //en utilisant des methodes symfony j'implemente ma variable $book avec les valeurs de mes collones de sql
        $bookForm = $this-> createForm(BookType::class, $book);
        // j'envoie le resultat sur ma page dédiée 
        return $this->render("admin/book_create.html.twig", [
            'bookForm' => $bookForm->createView()]);
    }
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

    public function LivreUpdate($id, BookRepository $bookRepository, EntityManagerInterface $entityManager){

    //dump("ok!!!!"); die;
        // je stock dans une variable un livre correspondant a l'id demandée dans l'URL.
        $livreUpdate = $bookRepository->find($id);
        //dans cette variable, j'indique grace a un setteur le changement de nom du livre
        $livreUpdate-> setTitle('Le Fada !');
        // la methode persist sert a préparer les entités a inserer en BDD.
        $entityManager-> persist($livreUpdate);
        // et j'insere les données modifiées en BDD
        $entityManager->flush();
        // j'affiche le rendu en l'envoyant sur ma page twig correspondante.
        return $this->render('admin/livre_uploaded.html.twig');

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

}