<?php

namespace App\Repository;

use App\Entity\Papier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;

/**
 * @method Papier|null find($id, $lockMode = null, $lockVersion = null)
 * @method Papier|null findOneBy(array $criteria, array $orderBy = null)
 * @method Papier[]    findAll()
 * @method Papier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PapierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Papier::class);
    }

    public function findAllSorted()
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.nazwa', 'ASC')

            ->getQuery()
            ->getResult()
            ;
    }
    public function findAllSortedArr()
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.nazwa', 'ASC')

            ->getQuery()
            ->getResult(Query::HYDRATE_ARRAY)
            ;
    }
    // /**
    //  * @return Papier[] Returns an array of Papier objects
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
    public function findOneBySomeField($value): ?Papier
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
