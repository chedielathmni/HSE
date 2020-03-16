<?php

namespace App\Repository;

use App\Entity\Protection;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Protection|null find($id, $lockMode = null, $lockVersion = null)
 * @method Protection|null findOneBy(array $criteria, array $orderBy = null)
 * @method Protection[]    findAll()
 * @method Protection[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProtectionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Protection::class);
    }

    // /**
    //  * @return Protection[] Returns an array of Protection objects
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
    public function findOneBySomeField($value): ?Protection
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
