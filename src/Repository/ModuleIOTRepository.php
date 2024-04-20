<?php

namespace App\Repository;

use App\Entity\ModuleIOT;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ModuleIOT>
 *
 * @method ModuleIOT|null find($id, $lockMode = null, $lockVersion = null)
 * @method ModuleIOT|null findOneBy(array $criteria, array $orderBy = null)
 * @method ModuleIOT[]    findAll()
 * @method ModuleIOT[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ModuleIOTRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ModuleIOT::class);
    }

    public function add(ModuleIOT $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ModuleIOT $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ModuleIOT[] Returns an array of ModuleIOT objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ModuleIOT
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
