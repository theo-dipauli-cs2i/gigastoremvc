<?php

namespace App\Repository;

use App\Entity\Livre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Livre>
 */
class LivreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Livre::class);
    }

    //    /**
    //     * @return Livre[] Returns an array of Livre objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('l')
    //            ->andWhere('l.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('l.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Livre
    //    {
    //        return $this->createQueryBuilder('l')
    //            ->andWhere('l.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function findByGenre(string $code_genre): array
    {
        return $this->createQueryBuilder('l')
            ->join('l.code_genre', 'g')
            ->where('g.code = :genre')
            ->setParameter('genre', $code_genre)
            ->orderBy('l.id', 'ASC')
            ->getQuery()
            ->getResult();
    }


    // public function findByNouveaute(): array
    // {
    //     return $this->createQueryBuilder('l')
    //         ->where('l.nouveaute = 1')
    //         ->orderBy('l.id', 'ASC')
    //         ->setMaxResults(3)
    //         ->getQuery()
    //         ->getResult();
    // }
}
