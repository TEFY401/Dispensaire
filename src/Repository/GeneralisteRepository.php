<?php

namespace App\Repository;

use App\Entity\Generaliste;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Generaliste|null find($id, $lockMode = null, $lockVersion = null)
 * @method Generaliste|null findOneBy(array $criteria, array $orderBy = null)
 * @method Generaliste[]    findAll()
 * @method Generaliste[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GeneralisteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Generaliste::class);
    }

    // /**
    //  * @return Generaliste[] Returns an array of Generaliste objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Generaliste
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
