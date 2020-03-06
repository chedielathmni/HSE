<?php

namespace App\Repository;

use App\Entity\ConseilPrudence;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ConseilPrudence|null find($id, $lockMode = null, $lockVersion = null)
 * @method ConseilPrudence|null findOneBy(array $criteria, array $orderBy = null)
 * @method ConseilPrudence[]    findAll()
 * @method ConseilPrudence[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConseilPrudenceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ConseilPrudence::class);
    }

    // /**
    //  * @return ConseilPrudence[] Returns an array of ConseilPrudence objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ConseilPrudence
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
