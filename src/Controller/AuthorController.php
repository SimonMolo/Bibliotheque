<?php

namespace App\Controller;

use App\Entity\Author;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AuthorRepository;
use Doctrine\ORM\EntityManagerInterface;

class AuthorController extends AbstractController
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

    // j'instancie la fonction createAuthor qui va me permettre d'ajouter des donées a ma BDD
    // je lui indique grace a des setteurs quels éléments vont a quel endroit dans la table
    public function createAuthor(entityManagerInterface $entityManager){
        //dump($author/create); die;
        $author=New author();
        $author-> setfirstName("Albert");
        $author-> setlastName("Camus");
        $author->setDeathDate(new \DateTime('1960-12-12'));

        // la methode persist sert a préparer les entités a inserer en BDD.
        // la methode flush sert a inserer les données en BDD lorsque elle est appelée.

        $entityManager->persist($author);
        $entityManager->flush();
        return $this->render("author_create.html.twig");
    }
    /**
     * @Route("/auteur/update/{id}", name="auteur_update")
     */

        public function AuteurUpdate($id, AuthorRepository $authorRepository, EntityManagerInterface $entityManager){
          //dump("Ok"); die;
            $authorUpdate = $authorRepository->find($id);
            $authorUpdate->setFirstName('KikiLaMouche');
            $entityManager -> persist($authorUpdate);
            $entityManager ->flush();
            return $this->render('auteur_uploaded.html.twig');

        }

    /**
     * @Route("/auteur/{id}", name="auteur")
     */
        public function auteurs($id, authorRepository $authorRepository){
        $author= $authorRepository->find($id);
        return $this->render('auteur.html.twig', ['author'=>$author]);
        }
}