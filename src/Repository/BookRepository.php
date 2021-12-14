<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }
        // Je crée une methode searchByTitle
    public function searchByTitle($word){
        //je cree une variable $queryBuilder en utilisant la fonction symfony createQueryBuilder
        $queryBuilder = $this->createQueryBuilder('book');
        // je fais une requette select dans ma table book
        $query=$queryBuilder->select('book')
            // je lui passe les parametre SQL
            ->where('book.title LIKE :word')
            // permet de preciser quil peut y avoir des caracteres avant et des caractere apres.
            ->setParameter('word', '%'.$word.'%')
            ->getQuery();
        return $query->getResult();
    }
    // /**
    //  * @return Book[] Returns an array of Book objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Book
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

