<?php

namespace App\Repository;

use App\Entity\Pictogramme;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Pictogramme|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pictogramme|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pictogramme[]    findAll()
 * @method Pictogramme[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PictogrammeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pictogramme::class);
    }

    // /**
    //  * @return Pictogramme[] Returns an array of Pictogramme objects
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
    public function findOneBySomeField($value): ?Pictogramme
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
