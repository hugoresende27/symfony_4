<?php

namespace App\Repository;

use App\Entity\Bitcoin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Bitcoin>
 *
 * @method Bitcoin|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bitcoin|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bitcoin[]    findAll()
 * @method Bitcoin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BitcoinRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bitcoin::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Bitcoin $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Bitcoin $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }


    public function findAllOrderedByCreatedAtDesc()
    {
        return $this->createQueryBuilder('b')
            ->orderBy('b.created_at', 'DESC')
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Bitcoin[] Returns an array of Bitcoin objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Bitcoin
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
