<?php

namespace App\Repository;

use App\Entity\Admin;
use App\Entity\Projet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Projet|null find($id, $lockMode = null, $lockVersion = null)
 * @method Projet|null findOneBy(array $criteria, array $orderBy = null)
 * @method Projet[]    findAll()
 * @method Projet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Projet::class);
    }

    public function findByProjectId($id)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.Budget = :val')
            ->setParameter('val', $id)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
    }
    public function getUpcomingProjectsByUser(Admin $user): QueryBuilder
    {
        $qb = $this->createQueryBuilder('p');

        return $qb
            ->Where('p.startDate > :now')
            ->andWhere('p.done = false')
            ->setParameter('user', $user);
    }

    /**
     * @return Query
     */
    public function getProjet(): Query
    {
        return $this->createQueryBuilder('p')
            ->getQuery();
    }

}
