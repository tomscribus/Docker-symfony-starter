<?php

namespace App\Repository;

use App\Entity\Resiliation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Resiliation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Resiliation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Resiliation[]    findAll()
 * @method Resiliation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResiliationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Resiliation::class);
    }

    // /**
    //  * @return Resiliation[] Returns an array of Resiliation objects
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
    public function findOneBySomeField($value): ?Resiliation
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
