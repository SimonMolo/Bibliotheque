<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class bibliothequeController extends abstractcontroller
{
// Je crée des routes sur mon controller pour indiquer a mon navigateur quelle page renvoyer

    /**
     * @Route("/", name="home")
     */

    public function accueil()
    {
        $livres = [
            1 => [
                "title" => "Dune",
                "author" => "Franck Herbert",
                "publishedAt" => new \DateTime('NOW'),
                "img"=>"https://images-na.ssl-images-amazon.com/images/I/A1u+2fY5yTL.jpg",
                "resume"=>"Le duc Leto Atréides, chef de la Maison Atréides, règne sur son fief planétaire de Caladan, une planète constituée de jungles et de vastes océans dont il tire sa puissance. Sa concubine officielle, dame Jessica, est une adepte du Bene Gesserit, une école exclusivement féminine qui poursuit de mystérieuses visées politiques et qui enseigne des capacités non moins étranges.",
                "id" => 1
            ],
            2 => [
                "title" => "Silo",
                "author" => "Tery Hayes",
                "publishedAt" => new \DateTime('NOW'),
                "resume"=>"En 2049, le monde est encore tel que nous le connaissons, mais le temps est compté. Seuls quelques potentats savent ce que l’avenir réserve… Deuxième volet, en forme de prequel, de la trilogie culte Silo, qui confère à l’univers imaginé par Hugh Howey une ampleur et une complexité saisissantes.",
                "img"=>"https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1403345411l/18144124.jpg",
                "id" => 2
            ],
            3 => [
                "title" => "Win",
                "author" => "Harlan Coben",
                "publishedAt" => new \DateTime('NOW'),
                "resume"=>" Il y a plus de vingt ans, l'héritière Patricia Lockwood a été enlevée lors d'un cambriolage du domaine familiale, puis enfermée dans une cabane isolée pendant des mois. Patricia s'est échappée, tout comme ses ravisseurs, mais les objets volés à sa famille n'ont jamais été retrouvés.",
                "img"=>"https://images-na.ssl-images-amazon.com/images/I/81MH9QEw+5L.jpg",
                "id" => 3
            ],
            4 => [
                "title" => "La part de l'autre",
                "author" => "Éric-Emmanuel Schmitt",
                "publishedAt" => new \DateTime('NOW'),
                "resume"=>"Le livre comprend deux scénarios parallèles : Tout d'abord, c'est la vie d'Adolf Hitler qui est décrite, du 8 octobre 1908 jusqu'à sa mort le 30 avril 1945 , ce qui inclut les conséquences de sa dictature comme la guerre froide, la partition de l'Allemagne et la fondation d'Israël.",
                "img"=>"https://images-na.ssl-images-amazon.com/images/I/71yoJZCdSaL.jpg",
                "id" => 4
            ],
            5 => [
                "title" => "Snowman",
                "author" => "Jo Nesbo",
                "publishedAt" => new \DateTime('NOW'),
                "resume"=>"Le détective de la police d'Oslo Harry Hole n'est plus que l'ombre de lui-même. Alcoolique, il cherche un but à sa carrière. C'est alors qu'il rencontre une nouvelle recrue, Katrine Bratt, fraîchement mutée de Bergen. Elle enquête sur la disparition d'une femme mariée et mère d'une petite fille, dont l'écharpe est trouvée enveloppée autour d'un bonhomme de neige sinistre. Harry Hole, qui a par ailleurs reçu une mystérieuse lettre ornée d'un bonhomme de neige, s'intéresse aux investigations de Katrine. Katrine et Harry vont alors découvrir que plusieurs femmes ont disparu dans des circonstances similaires.",
                "img"=>"https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1355881478l/9572203.jpg",
                "id" => 5
            ]
        ];
        // je crée une variable "lastBooks" qui contient mes 3 derniers livres de ma liste
        $lastBooks = array_slice($livres,-3,3);
        //je retoure ensuite le resultat en precisant mon chemin twig puis le nom de la variable que je veut envoyer
        //suivi de ce que contient la variable que je viens de creer.
        return $this->render('home.html.twig',['lastBooks' => $lastBooks]);
    }




    /**
     * @Route("/livres", name="livres")
     */
    public function livres()
    {
        $livres = [
            1 => [
                "title" => "Dune",
                "author" => "Franck Herbert",
                "publishedAt" => new \DateTime('NOW'),
                "img"=>"https://images-na.ssl-images-amazon.com/images/I/A1u+2fY5yTL.jpg",
                "resume"=>"Le duc Leto Atréides, chef de la Maison Atréides, règne sur son fief planétaire de Caladan, une planète constituée de jungles et de vastes océans dont il tire sa puissance. Sa concubine officielle, dame Jessica, est une adepte du Bene Gesserit, une école exclusivement féminine qui poursuit de mystérieuses visées politiques et qui enseigne des capacités non moins étranges.",
                "id" => 1
            ],
            2 => [
                "title" => "Silo",
                "author" => "Tery Hayes",
                "publishedAt" => new \DateTime('NOW'),
                "resume"=>"En 2049, le monde est encore tel que nous le connaissons, mais le temps est compté. Seuls quelques potentats savent ce que l’avenir réserve… Deuxième volet, en forme de prequel, de la trilogie culte Silo, qui confère à l’univers imaginé par Hugh Howey une ampleur et une complexité saisissantes.",
                "img"=>"https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1403345411l/18144124.jpg",
                "id" => 2
            ],
            3 => [
                "title" => "Win",
                "author" => "Harlan Coben",
                "publishedAt" => new \DateTime('NOW'),
                "resume"=>" Il y a plus de vingt ans, l'héritière Patricia Lockwood a été enlevée lors d'un cambriolage du domaine familiale, puis enfermée dans une cabane isolée pendant des mois. Patricia s'est échappée, tout comme ses ravisseurs, mais les objets volés à sa famille n'ont jamais été retrouvés.",
                "img"=>"https://images-na.ssl-images-amazon.com/images/I/81MH9QEw+5L.jpg",
                "id" => 3
            ],
            4 => [
                "title" => "La part de l'autre",
                "author" => "Éric-Emmanuel Schmitt",
                "publishedAt" => new \DateTime('NOW'),
                "resume"=>"Le livre comprend deux scénarios parallèles : Tout d'abord, c'est la vie d'Adolf Hitler qui est décrite, du 8 octobre 1908 jusqu'à sa mort le 30 avril 1945 , ce qui inclut les conséquences de sa dictature comme la guerre froide, la partition de l'Allemagne et la fondation d'Israël.",
                "img"=>"https://images-na.ssl-images-amazon.com/images/I/71yoJZCdSaL.jpg",
                "id" => 4
            ],
            5 => [
                "title" => "Snowman",
                "author" => "Jo Nesbo",
                "publishedAt" => new \DateTime('NOW'),
                "resume"=>"Le détective de la police d'Oslo Harry Hole n'est plus que l'ombre de lui-même. Alcoolique, il cherche un but à sa carrière. C'est alors qu'il rencontre une nouvelle recrue, Katrine Bratt, fraîchement mutée de Bergen. Elle enquête sur la disparition d'une femme mariée et mère d'une petite fille, dont l'écharpe est trouvée enveloppée autour d'un bonhomme de neige sinistre. Harry Hole, qui a par ailleurs reçu une mystérieuse lettre ornée d'un bonhomme de neige, s'intéresse aux investigations de Katrine. Katrine et Harry vont alors découvrir que plusieurs femmes ont disparu dans des circonstances similaires.",
                "img"=>"https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1355881478l/9572203.jpg",
                "id" => 5
            ]
        ];

        return $this->render('livres.html.twig', ['livres' => $livres]);
    }

    /**
     * @Route("/livre/{id}", name="livre")
     */
    public function livre($id)
    {
        $livres = [
            1 => [
                "title" => "Dune",
                "author" => "Franck Herbert",
                "publishedAt" => new \DateTime('NOW'),
                "img"=>"https://images-na.ssl-images-amazon.com/images/I/A1u+2fY5yTL.jpg",
                "resume"=>"Le duc Leto Atréides, chef de la Maison Atréides, règne sur son fief planétaire de Caladan, une planète constituée de jungles et de vastes océans dont il tire sa puissance. Sa concubine officielle, dame Jessica, est une adepte du Bene Gesserit, une école exclusivement féminine qui poursuit de mystérieuses visées politiques et qui enseigne des capacités non moins étranges.",
                "id" => 1
            ],
            2 => [
                "title" => "Silo",
                "author" => "Tery Hayes",
                "publishedAt" => new \DateTime('NOW'),
                "resume"=>"En 2049, le monde est encore tel que nous le connaissons, mais le temps est compté. Seuls quelques potentats savent ce que l’avenir réserve… Deuxième volet, en forme de prequel, de la trilogie culte Silo, qui confère à l’univers imaginé par Hugh Howey une ampleur et une complexité saisissantes.",
                "img"=>"https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1403345411l/18144124.jpg",
                "id" => 2
            ],
            3 => [
                "title" => "Win",
                "author" => "Harlan Coben",
                "publishedAt" => new \DateTime('NOW'),
                "resume"=>" Il y a plus de vingt ans, l'héritière Patricia Lockwood a été enlevée lors d'un cambriolage du domaine familiale, puis enfermée dans une cabane isolée pendant des mois. Patricia s'est échappée, tout comme ses ravisseurs, mais les objets volés à sa famille n'ont jamais été retrouvés.",
                "img"=>"https://images-na.ssl-images-amazon.com/images/I/81MH9QEw+5L.jpg",
                "id" => 3
            ],
            4 => [
                "title" => "La part de l'autre",
                "author" => "Éric-Emmanuel Schmitt",
                "publishedAt" => new \DateTime('NOW'),
                "resume"=>"Le livre comprend deux scénarios parallèles : Tout d'abord, c'est la vie d'Adolf Hitler qui est décrite, du 8 octobre 1908 jusqu'à sa mort le 30 avril 1945 , ce qui inclut les conséquences de sa dictature comme la guerre froide, la partition de l'Allemagne et la fondation d'Israël.",
                "img"=>"https://images-na.ssl-images-amazon.com/images/I/71yoJZCdSaL.jpg",
                "id" => 4
            ],
            5 => [
                "title" => "Snowman",
                "author" => "Jo Nesbo",
                "publishedAt" => new \DateTime('NOW'),
                "resume"=>"Le détective de la police d'Oslo Harry Hole n'est plus que l'ombre de lui-même. Alcoolique, il cherche un but à sa carrière. C'est alors qu'il rencontre une nouvelle recrue, Katrine Bratt, fraîchement mutée de Bergen. Elle enquête sur la disparition d'une femme mariée et mère d'une petite fille, dont l'écharpe est trouvée enveloppée autour d'un bonhomme de neige sinistre. Harry Hole, qui a par ailleurs reçu une mystérieuse lettre ornée d'un bonhomme de neige, s'intéresse aux investigations de Katrine. Katrine et Harry vont alors découvrir que plusieurs femmes ont disparu dans des circonstances similaires.",
                "img"=>"https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1355881478l/9572203.jpg",
                "id" => 5
            ]
        ];
        // grace a une fonction Php existante, je verifie si la clé demandé dans mon URL existe, sinon, je configure le message a renvoyer dans l'erreur 404
        if(!array_key_exists($id, $livres)){
            throw $this->createNotFoundException("Ce livre n'est pas disponible");
        }
        $livre = $livres[$id];


        return $this->render('livre.html.twig', ['livre' => $livre]);


    }
}