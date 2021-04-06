<?php

namespace App\Repository;

use App\Entity\Personel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Personel|null find($id, $lockMode = null, $lockVersion = null)
 * @method Personel|null findOneBy(array $criteria, array $orderBy = null)
 * @method Personel[]    findAll()
 * @method Personel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Personel::class);
    }

    // /**
    //  * @return Personel[] Returns an array of Personel objects
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
    public function findOneBySomeField($value): ?Personel
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
