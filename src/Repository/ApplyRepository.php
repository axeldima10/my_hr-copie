<?php

namespace App\Repository;

use App\Entity\Apply;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Apply>
 */
class ApplyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Apply::class);
    }


    public function findByFilters(array $filters)
    {
        $qb = $this->createQueryBuilder('a');
        //$qb->leftJoin('a.skills', 's');
    
        if (!empty($filters['reference'])) {
            $qb->andWhere('a.reference LIKE :reference')
               ->setParameter('reference', '%' . $filters['reference'] . '%');
        }
    
        if (!empty($filters['experience'])) {
            $qb->andWhere('a.experience IN (:experience)')
               ->setParameter('experience', $filters['experience']);
        }
    
       /*  if (!empty($filters['skills'])) {
            $qb->andWhere('a.skills IN (:skills)')
               ->setParameter('skills', $filters['skills']);
        } */
    
        if (!empty($filters['diplome'])) {
            $qb->andWhere('a.diplome IN (:diplome)')
               ->setParameter('diplome', $filters['diplome']);
        }
    
        return $qb->getQuery()->getResult();
    }
    

//    /**
//     * @return Apply[] Returns an array of Apply objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Apply
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }



    
}
