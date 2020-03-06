<?php

namespace App\Repository;

use App\Entity\MentionDanger;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method MentionDanger|null find($id, $lockMode = null, $lockVersion = null)
 * @method MentionDanger|null findOneBy(array $criteria, array $orderBy = null)
 * @method MentionDanger[]    findAll()
 * @method MentionDanger[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MentionDangerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MentionDanger::class);
    }

    // /**
    //  * @return MentionDanger[] Returns an array of MentionDanger objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MentionDanger
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
