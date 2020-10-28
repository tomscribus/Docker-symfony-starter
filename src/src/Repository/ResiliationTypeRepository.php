<?php

namespace App\Repository;

use App\Entity\ResiliationType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ResiliationType|null find($id, $lockMode = null, $lockVersion = null)
 * @method ResiliationType|null findOneBy(array $criteria, array $orderBy = null)
 * @method ResiliationType[]    findAll()
 * @method ResiliationType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResiliationTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ResiliationType::class);
    }

    // /**
    //  * @return ResiliationType[] Returns an array of ResiliationType objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ResiliationType
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
