<?php

namespace App\Repository;

use App\Entity\DatabaseServer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DatabaseServer|null find($id, $lockMode = null, $lockVersion = null)
 * @method DatabaseServer|null findOneBy(array $criteria, array $orderBy = null)
 * @method DatabaseServer[]    findAll()
 * @method DatabaseServer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DatabaseServerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DatabaseServer::class);
    }

    // /**
    //  * @return DatabaseServer[] Returns an array of DatabaseServer objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DatabaseServer
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
