<?php

namespace App\Repository;

use App\Entity\TapezUnMessage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TapezUnMessage|null find($id, $lockMode = null, $lockVersion = null)
 * @method TapezUnMessage|null findOneBy(array $criteria, array $orderBy = null)
 * @method TapezUnMessage[]    findAll()
 * @method TapezUnMessage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TapezUnMessageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TapezUnMessage::class);
    }

    // /**
    //  * @return TapezUnMessage[] Returns an array of TapezUnMessage objects
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
    public function findOneBySomeField($value): ?TapezUnMessage
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
