<?php

namespace App\Repository;

use App\Entity\Projet;
use App\Entity\User;
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

    public function projectStatus($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.name = :val')
            ->select($this->count('p.title'))
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }

    public function countNumberProjectForStatus(Projet $projet)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.projet = :projet')
            ->setParameter('projet', $projet)
            ->select('SUM(p.name) as projectByStatus')
            ->andWhere()
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Query
     */
    public function getProjet(): Query
    {
        return $this->createQueryBuilder('p')
            ->getQuery();
    }

    public function getProjectsByUser(User $user): QueryBuilder
    {
        return $this->createQueryBuilder('p')
            ->join('p.team', 't')
            ->where(':user MEMBER OF t.members')
            ->setParameter('user', $user);
    }

    // get all the active projects of a given user
    public function getActiveProjectsByUser(User $user, bool $withRisks = false): QueryBuilder
    {
        $qb = $this->createQueryBuilder('p');

        $qb
            ->join('p.team', 't')
            ->where($qb->expr()->orX(
                $qb->expr()->eq('t.responsible', ':user'),
                $qb->expr()->isMemberOf(':user', 't.members')
            ))
            ->andWhere('p.endAt > :now')
            ->andWhere('p.startAt < :now')
            ->andWhere('p.archived = false')
            ->setParameter('user', $user)
            ->setParameter('now', new \DateTime());

        if ($withRisks) {
            $qb
                ->leftJoin('p.risks', 'r')
                ->andWhere('r.id IS NOT NULL');
        }

        return $qb;
    }

    // get all the upcoming projects of a given user
    public function getUpcomingProjectsByUser(User $user): QueryBuilder
    {
        $qb = $this->createQueryBuilder('p');

        return $qb
            ->join('p.team', 't')
            ->where($qb->expr()->orX(
                $qb->expr()->eq('t.responsible', ':user'),
                $qb->expr()->isMemberOf(':user', 't.members')
            ))
            ->andWhere('p.startAt > :now')
            ->andWhere('p.archived = false')
            ->setParameter('user', $user)
            ->setParameter('now', new \DateTime());
    }


    // /**
    //  * @return Projet[] Returns an array of Projet objects
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
    public function findOneBySomeField($value): ?Projet
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
