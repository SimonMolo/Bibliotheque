<?php

namespace App\Controller;

use App\Entity\Author;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AuthorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Form\AuthorType;

class AdminAuthorController extends AbstractController
{
    /**
     * @Route("/admin/auteurs", name="admin_auteurs")
     */
    public function authors(authorRepository $authorRepository){

        $authors =$authorRepository->findAll();
        return $this->render("admin/auteurs.html.twig", ['authors'=> $authors]);

    }
    /**
     *@Route("/admin/auteur/create", name="admin_auteur_create")
     */

    // j'instancie la fonction createAuthor qui va me permettre d'ajouter des donées a ma BDD
    // je lui indique grace a des setteurs quels éléments vont a quel endroit dans la table
    public function createAuthor(Request $request,entityManagerInterface $entityManager){


            $author = new Author();
            //ca cree un formulaire en créant autant d'inputs que de collones dans mon tableau sql
            $authorForm = $this-> createForm(AuthorType::class, $author);
            // je recupere les valeurs de tous les inputs pour verifier si le formulaire est rempli et envoyé.
            $authorForm-> handleRequest($request);
            // si le formulaire est soumis et valide,
            if ($authorForm->isSubmitted() && $authorForm->isValid()){
                // j'envoie les données de la requette dans l'entitée book
                $entityManager->persist($author);
                // j'envoie l'entité book dans ma BDD
                $entityManager-> flush();
                return $this->redirectToRoute('admin_auteurs');
            }
            // j'envoie le resultat sur ma page dédiée
            return $this->render("admin/author_create.html.twig", [
                'authorForm' => $authorForm->createView()]);

    }
    /**
     * @Route("/admin/auteur/update/{id}", name="admin_auteur_update")
     */

        public function AuteurUpdate($id,Request $request,  AuthorRepository $authorRepository, EntityManagerInterface $entityManager){
            $author = $authorRepository->find($id);
            $authorForm = $this-> createForm(AuthorType::class, $author);
            // je recupere les valeurs de tous les inputs pour verifier si le formulaire est rempli et envoyé.
            $authorForm-> handleRequest($request);
            // si le formulaire est soumis et valide,
            if ($authorForm->isSubmitted() && $authorForm->isValid()){
                // j'envoie les données de la requette dans l'entitée book
                $entityManager->persist($author);
                // j'envoie l'entité book dans ma BDD
                $entityManager-> flush();
                return $this->redirectToRoute('admin_auteurs');
            }
            // j'envoie le resultat sur ma page dédiée
            return $this->render("admin/author_uploaded.html.twig", [
                'authorForm' => $authorForm->createView()]);


        }

    /**
     * @Route("/admin/auteur/delete/{id}", name="admin_auteur_delete")
     */
public function auteurDelete($id, AuthorRepository $authorRepository, EntityManagerInterface $entityManager){
    //dump('Ok'); die;
    $auteur = $authorRepository->find($id);
    $entityManager->remove($auteur);
    $entityManager->flush();
    return $this->redirectToRoute('admin_auteurs');
}
    /**
     * @Route("/admin/auteur/{id}", name="admin_auteur")
     */
        public function auteurs($id, authorRepository $authorRepository){
        $author= $authorRepository->find($id);
        return $this->render('admin/auteur.html.twig', ['author'=>$author]);
        }
}