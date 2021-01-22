<?php

namespace App\Repository;

use App\Entity\Packet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Packet|null find($id, $lockMode = null, $lockVersion = null)
 * @method Packet|null findOneBy(array $criteria, array $orderBy = null)
 * @method Packet[]    findAll()
 * @method Packet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PacketRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Packet::class);
    }

    // /**
    //  * @return Packet[] Returns an array of Packet objects
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
    public function findOneBySomeField($value): ?Packet
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
