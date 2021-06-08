<?php

namespace App\Repository;

use App\Entity\DateCreated;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DateCreated|null find($id, $lockMode = null, $lockVersion = null)
 * @method DateCreated|null findOneBy(array $criteria, array $orderBy = null)
 * @method DateCreated[]    findAll()
 * @method DateCreated[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DateCreatedRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DateCreated::class);
    }

    // /**
    //  * @return DateCreated[] Returns an array of DateCreated objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DateCreated
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
