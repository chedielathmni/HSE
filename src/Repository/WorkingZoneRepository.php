<?php

namespace App\Repository;

use App\Entity\WorkingZone;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method WorkingZone|null find($id, $lockMode = null, $lockVersion = null)
 * @method WorkingZone|null findOneBy(array $criteria, array $orderBy = null)
 * @method WorkingZone[]    findAll()
 * @method WorkingZone[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WorkingZoneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WorkingZone::class);
    }

    // /**
    //  * @return WorkingZone[] Returns an array of WorkingZone objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?WorkingZone
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
