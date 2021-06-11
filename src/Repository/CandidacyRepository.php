<?php

namespace App\Repository;

use App\Entity\Candidacy;
use App\Entity\Client;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\Query\Expr\Join;

/**
 * @method Candidacy|null find($id, $lockMode = null, $lockVersion = null)
 * @method Candidacy|null findOneBy(array $criteria, array $orderBy = null)
 * @method Candidacy[]    findAll()
 * @method Candidacy[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CandidacyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Candidacy::class);
    }

    // /**
    //  * @return Candidacy[] Returns an array of Candidacy objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    

    /**
     * @return Candidacy[] Returns an array of Candidacy objects
     */
    public function findAllCandidacyFromClient($value): array
    {
        return $this->createQueryBuilder('candidacy')
  
        ->addSelect('candidate')
        ->join('candidacy.candidate' , 'candidate','WITH', 'candidate = candidacy.candidate')

        ->addSelect('jobOffer') 
        ->join('candidacy.jobOffer' , 'jobOffer','WITH', 'jobOffer = candidacy.jobOffer')

        ->addSelect('client')
        ->join('jobOffer.client' , 'client','WITH', 'client = jobOffer.client')

        ->where('jobOffer.client = :value')
        ->setParameter('value', $value)

        ->getQuery()
        ->getResult();   
    }

    public function findJobOfferCandidacy($jobOffer, $candidate)
    {
        return $this->createQueryBuilder('candidacy')
        ->where('candidacy.jobOffer= :jobOffer')  
        ->setParameter('jobOffer', $jobOffer->getId())
        ->andWhere('candidacy.candidate= :candidate')
        ->setParameter('candidate', $candidate->getId())
        ->getQuery()
        ->getOneOrNullResult();   
    }

    //buscar todas las ofertas de trabajo con el id del cliente, a partir de estas ofertas buscar las
    //cadidaturas con este id
}
