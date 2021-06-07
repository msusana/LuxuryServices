<?php

namespace App\Repository;

use App\Entity\StartingDate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method StartingDate|null find($id, $lockMode = null, $lockVersion = null)
 * @method StartingDate|null findOneBy(array $criteria, array $orderBy = null)
 * @method StartingDate[]    findAll()
 * @method StartingDate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StartingDateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StartingDate::class);
    }

    // /**
    //  * @return StartingDate[] Returns an array of StartingDate objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?StartingDate
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
