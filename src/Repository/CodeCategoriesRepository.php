<?php

namespace App\Repository;

use App\Entity\CodeCategories;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CodeCategories>
 *
 * @method CodeCategories|null find($id, $lockMode = null, $lockVersion = null)
 * @method CodeCategories|null findOneBy(array $criteria, array $orderBy = null)
 * @method CodeCategories[]    findAll()
 * @method CodeCategories[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CodeCategoriesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CodeCategories::class);
    }

//    /**
//     * @return CodeCategories[] Returns an array of CodeCategories objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CodeCategories
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
