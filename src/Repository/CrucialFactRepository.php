<?php

namespace App\Repository;

use App\Entity\CrucialFact;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CrucialFact|null find($id, $lockMode = null, $lockVersion = null)
 * @method CrucialFact|null findOneBy(array $criteria, array $orderBy = null)
 * @method CrucialFact[]    findAll()
 * @method CrucialFact[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CrucialFactRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CrucialFact::class);
    }

    // /**
    //  * @return CrucialFact[] Returns an array of CrucialFact objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CrucialFact
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
