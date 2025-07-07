<?php

namespace App\Repository;

use App\Entity\Festival;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Festival>
 */
class FestivalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Festival::class);
    }

    /**
     * @return string[] Array of unique location names.
     */
    public function findAllUniqueLocations(): array
    {
        return $this->createQueryBuilder('f')
            ->select('DISTINCT f.location')
            ->orderBy('f.location', 'ASC')
            ->getQuery()
            ->getSingleColumnResult();
    }

    /**
     * Find upcoming festivals in a specific location.
     *
     * @param string $locationName The name of the location to filter by.
     * @return Festival[] Returns an array of Festival objects.
     */
    public function findUpcomingByLocation(string $locationName): array
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.location = :location')
            ->andWhere('f.startDate >= :now')
            ->setParameter('location', $locationName)
            ->setParameter('now', new \DateTimeImmutable())
            ->orderBy('f.startDate', 'ASC')
            ->addOrderBy('f.name', 'ASC')
            ->getQuery()
            ->getResult();
    }

    //    /**
    //     * @return Festival[] Returns an array of Festival objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('f')
    //            ->andWhere('f.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('f.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Festival
    //    {
    //        return $this->createQueryBuilder('f')
    //            ->andWhere('f.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
