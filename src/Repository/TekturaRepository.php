<?php

namespace App\Repository;

use App\Entity\Tektura;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Tektura|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tektura|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tektura[]    findAll()
 * @method Tektura[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TekturaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tektura::class);
    }
    public function findAllSorted()
    {
        return $this->createQueryBuilder('t')
            ->orderBy('t.nazwa', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }
    // /**
    //  * @return Tektura[] Returns an array of Tektura objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Tektura
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
