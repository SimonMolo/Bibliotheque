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


class pagesController extends AbstractController
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
    return $this->render("public/home.html.twig", ['lastBooks'=> $lastBooks]);
    }
    /**
     * @Route("/admin/home", name="admin_home")
     */
    public function adminHome(BookRepository $bookRepository){
        $lastBooks = $bookRepository->findBy(array(),array('id'=>'DESC'),3,0);
        return $this->render("admin/admin_home.html.twig", ['lastBooks'=> $lastBooks]);
    }
}