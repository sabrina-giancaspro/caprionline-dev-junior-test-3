<?php

namespace App\Repository;

use App\Entity\Genre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Mapping\OrderBy;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Genre>
 *
 * @method Genre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Genre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Genre[]    findAll()
 * @method Genre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GenreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Genre::class);
    }

    public function findAll(): array
    {
        return $this->createQueryBuilder('g')
            ->select('g.name')
            ->leftJoin('g.movies', 'movies')
            ->addSelect('movies.title')
            ->getQuery()
            ->getResult();
    }

    public function getMoviesByGenre($value, $orderBy = null): array
    {
        $query = $this->createQueryBuilder('g');
        
            $query
            ->select('g.name')
            ->leftJoin('g.movies', 'movies')
            ->andWhere('g.name = :genre_name')
            ->setParameter('genre_name', $value)
            ->addSelect('movies.id','movies.title', 'movies.imageUrl', 'movies.plot',  'movies.year', 'movies.releaseDate', 'movies.duration', 'movies.rating', 'movies.wikipediaUrl');
        
        if ($orderBy !== null) {
            if ($orderBy === 'recent') {
                // ordino per data di rilascio in ordine decrescente 
                $query->orderBy('movies.releaseDate', 'DESC');
            } elseif ($orderBy === 'rating') {
                // ordino per rating 
                $query->orderBy('movies.rating', 'DESC');
            }
        }
        return $query
        ->getQuery()
        ->getResult();
    }
    //    /**
    //     * @return Genre[] Returns an array of Genre objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('g.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Genre
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
