<?php

namespace App\Repository;

use App\Entity\ProprietaireNft;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProprietaireNft>
 *
 * @method ProprietaireNft|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProprietaireNft|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProprietaireNft[]    findAll()
 * @method ProprietaireNft[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProprietaireNftRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProprietaireNft::class);
    }

//    /**
//     * @return ProprietaireNft[] Returns an array of ProprietaireNft objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ProprietaireNft
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
