<?php

namespace App\Repository;

use App\Entity\AudienceType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AudienceType|null find($id, $lockMode = null, $lockVersion = null)
 * @method AudienceType|null findOneBy(array $criteria, array $orderBy = null)
 * @method AudienceType[]    findAll()
 * @method AudienceType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AudienceTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AudienceType::class);
    }

    // /**
    //  * @return AudienceType[] Returns an array of AudienceType objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AudienceType
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
