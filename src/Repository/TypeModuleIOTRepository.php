<?php

namespace App\Repository;

use App\Entity\TypeModuleIOT;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TypeModuleIOT>
 *
 * @method TypeModuleIOT|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeModuleIOT|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeModuleIOT[]    findAll()
 * @method TypeModuleIOT[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeModuleIOTRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeModuleIOT::class);
    }

    public function add(TypeModuleIOT $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(TypeModuleIOT $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return TypeModuleIOT[] Returns an array of TypeModuleIOT objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TypeModuleIOT
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
