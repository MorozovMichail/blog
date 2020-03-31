<?php

namespace App\Repository;

use App\Entity\UserFeedBack;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method UserFeedBack|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserFeedBack|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserFeedBack[]    findAll()
 * @method UserFeedBack[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserFeedBackRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserFeedBack::class);
    }

    // /**
    //  * @return UserFeedBack[] Returns an array of UserFeedBack objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserFeedBack
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
