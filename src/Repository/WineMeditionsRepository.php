<?php

namespace App\Repository;

use App\Entity\WineMeditions;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<WineMeditions>
 */
class WineMeditionsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WineMeditions::class);
    }

    //    /**
    //     * @return WineMeditions[] Returns an array of WineMeditions objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('w')
    //            ->andWhere('w.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('w.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    public function findAllWithWineName(): array
    {
        return $this->createQueryBuilder('m')
            ->select('m, v.name as wineName')
            ->innerJoin('App\Entity\Wines', 'v', 'WITH', 'm.idwine = v.id')
            ->getQuery()
            ->getResult();
    }

    //    public function findOneBySomeField($value): ?WineMeditions
    //    {
    //        return $this->createQueryBuilder('w')
    //            ->andWhere('w.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
