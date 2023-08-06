<?php

namespace App\Repository;

use App\Entity\QuoiDeNeufLesDevs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<QuoiDeNeufLesDevs>
 *
 * @method QuoiDeNeufLesDevs|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuoiDeNeufLesDevs|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuoiDeNeufLesDevs[]    findAll()
 * @method QuoiDeNeufLesDevs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuoiDeNeufLesDevsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuoiDeNeufLesDevs::class);
    }

//    /**
//     * @return QuoiDeNeufLesDevs[] Returns an array of QuoiDeNeufLesDevs objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('q')
//            ->andWhere('q.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('q.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?QuoiDeNeufLesDevs
//    {
//        return $this->createQueryBuilder('q')
//            ->andWhere('q.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
