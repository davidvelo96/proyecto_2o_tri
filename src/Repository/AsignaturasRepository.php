<?php

namespace App\Repository;

use App\Entity\Asignaturas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Asignaturas|null find($id, $lockMode = null, $lockVersion = null)
 * @method Asignaturas|null findOneBy(array $criteria, array $orderBy = null)
 * @method Asignaturas[]    findAll()
 * @method Asignaturas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AsignaturasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Asignaturas::class);
    }

    // /**
    //  * @return Asignaturas[] Returns an array of Asignaturas objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Asignaturas
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
