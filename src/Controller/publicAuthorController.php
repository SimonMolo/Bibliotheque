<?php

namespace App\Controller;

use App\Repository\AuthorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Book;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\BookType;
use Symfony\Component\HttpFoundation\Request;
class publicAuthorController extends abstractController
{


    /**
     * @Route("admin/authors", name="authors")
     */
    public function authors(authorRepository $authorRepository){

        $authors =$authorRepository->findAll();
        return $this->render("public/authors.html.twig", ['authors'=> $authors]);

    }
    /**
     * @Route("admin/author/{id}", name="author")
     */
    public function auteurs($id, authorRepository $authorRepository){
        $author= $authorRepository->find($id);
        return $this->render('public/author.html.twig', ['author'=>$author]);
    }
}