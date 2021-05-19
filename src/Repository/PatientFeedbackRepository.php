<?php

namespace App\Repository;

use App\Entity\PatientFeedback;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PatientFeedback|null find($id, $lockMode = null, $lockVersion = null)
 * @method PatientFeedback|null findOneBy(array $criteria, array $orderBy = null)
 * @method PatientFeedback[]    findAll()
 * @method PatientFeedback[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PatientFeedbackRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PatientFeedback::class);
    }

    // /**
    //  * @return PatientFeedback[] Returns an array of PatientFeedback objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PatientFeedback
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
