<?php

namespace App\Repository;

use App\Entity\Sites;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Sites|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sites|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sites[]    findAll()
 * @method Sites[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SitesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Sites::class);
    }

//    /**
//     * @return Sites[] Returns an array of Sites objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Sites
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function getAllSitesWithTimes()
    {
        $em = $this->getEntityManager();
        $db = $em->createQueryBuilder();

        $db
            ->select(array('s', 'e'))
            ->from('App:Sites', 's')
            ->leftJoin('s.era', 'e');

        $query = $db->getQuery();
        $result = $query->getResult();

        return $result;


    }
}
