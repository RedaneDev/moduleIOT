<?php

namespace App\Repository;

use App\Entity\DataModuleIOT;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DataModuleIOT>
 *
 * @method DataModuleIOT|null find($id, $lockMode = null, $lockVersion = null)
 * @method DataModuleIOT|null findOneBy(array $criteria, array $orderBy = null)
 * @method DataModuleIOT[]    findAll()
 * @method DataModuleIOT[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DataModuleIOTRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DataModuleIOT::class);
    }

    public function add(DataModuleIOT $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(DataModuleIOT $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return DataModuleIOT[] Returns an array of DataModuleIOT objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?DataModuleIOT
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
