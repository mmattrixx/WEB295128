<?php

namespace App\Repository;

use App\Entity\Pomiary;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use http\Params;

/**
 * @method Pomiary|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pomiary|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pomiary[]    findAll()
 * @method Pomiary[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PomiaryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pomiary::class);
    }

     /**
      * @return Pomiary[] Returns an array of Pomiary objects
      */

    public function findByYear($value)
    {
        return $this->createQueryBuilder('p')
        ->andWhere('YEAR(p.DataWykonania) = :val')
        ->setParameter('val', $value)
            ->orderBy('p.DataWykonania','DESC')
        ->getQuery()
        ->getResult()
        ;
    }
    public function  findByYearT200($value)
    {
        return $this->createQueryBuilder('p')
        ->andWhere('YEAR(p.DataWykonania) = :val')
        ->setParameter('val', $value)
            ->orderBy('p.DataWykonania','DESC')
        ->getQuery()
            ->setMaxResults(200)
        ->getResult()
        ;
    }
    public function findBySearchFilters($parameters)
    {

        $dataEntity=[
            1=>'pomiar1',
            2=>'pomiar2',
            3=>'pomiar3',
            4=>'pomiar4',
            5=>'pomiar5',
            6=>'numer_programu',
            7=>'NumerZlecenia',
            8=>'ect_max',
            9=>'ect_min',
            10=>'ect_avg',
            11=>'standard_deviation',
            12=>'waga',
            13=>'temperatura_ect',
            14=>'wilgostnosc_ect ',
            15=>'wilgotnosc_mierzona',
            16=>'grubosc_tektury'

        ];
        $query=$this->createQueryBuilder('p')
        ->andWhere("p.DataWykonania >= :fromdatex")->setParameter("fromdatex",$parameters['fromdate'])
        ->andWhere("p.DataWykonania <= :todate")->setParameter("todate",$parameters['todate']." 23:59:59");
        if($parameters['tektura']!=""){
            $query=$query->andWhere("p.tektura = :tekturap")->setParameter('tekturap',$parameters['tektura']);
        }
        if($parameters['pokrycie1']!=""){
            $query=$query->andWhere("p.pokrycie1 = :pokrycie1")->setParameter('pokrycie1',$parameters['pokrycie1']);
        }
        if($parameters['pokrycie2']!=""){
            $query=$query->andWhere("p.pokrycie2 = :pokrycie2")->setParameter('pokrycie2',$parameters['pokrycie2']);
        }
        if($parameters['pokrycie3']!=""){
            $query=$query->andWhere("p.pokrycie3 = :pokrycie3")->setParameter('pokrycie3',$parameters['pokrycie3']);
        }
        if($parameters['fala1']!=""){
            $query=$query->andWhere("p.fala1 = :fala1")->setParameter('fala1',$parameters['fala1']);
        }
        if($parameters['fala2']!=""){
            $query=$query->andWhere("p.fala2 = :fala2")->setParameter('fala2',$parameters['fala2']);
        }
        if($parameters['userInsert']!=""){
            $query=$query->andWhere("p.user = :userInsert")->setParameter('userInsert',$parameters['userInsert']);
        }

        foreach ($dataEntity as $index => $item) {
            if($parameters["val$index"]!=""){
                $op="like";
                if($index==7){
                    if($parameters["oper$index"]=="!=") $op="not like ";
                }
               $query= $query->andWhere("p.$item  $op :val$index")
                    ->setParameter("val$index", "%".trim($parameters["val$index"])."%");
            }

        }



        return  $query ->orderBy('p.DataWykonania','DESC')
            ->getQuery()
            ->getResult();

    }


    /*
    public function findOneBySomeField($value): ?Pomiary
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
