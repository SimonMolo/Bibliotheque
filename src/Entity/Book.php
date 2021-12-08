<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\BookRepository;

/**
 * @ORM\Entity(repositoryClass=BookRepository::class)
 */
class Book

{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */

    private $title;


    /**
     * @ORM\Column(type="integer")
     */

    private $nbPages;

    /**
     * @ORM\Column(type="date")
     */

    private $Date;



    private $genre;

    /**
     * @ORM\ManyToOne(targetEntity=Author::class, inversedBy="books")
     */
    private $Author;

   
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }


    /**
     * @return mixed
     */
    public function getNbPages()
    {
        return $this->nbPages;
    }

    /**
     * @param mixed $nbPages
     */
    public function setNbPages($nbPages): void
    {
        $this->nbPages = $nbPages;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->Date;
    }

    /**
     * @param mixed $Date
     */
    public function setDate($Date): void
    {
        $this->Date = $Date;
    }



    public function getGenre(): ?author
    {
        return $this->genre;
    }

    public function setGenre(?author $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getAuthor(): ?author
    {
        return $this->Author;
    }

    public function setAuthor(?author $Author): self
    {
        $this->Author = $Author;

        return $this;
    }



}


