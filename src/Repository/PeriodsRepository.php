<?php

namespace App\Repository;

use App\Entity\Periods;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Periods|null find($id, $lockMode = null, $lockVersion = null)
 * @method Periods|null findOneBy(array $criteria, array $orderBy = null)
 * @method Periods[]    findAll()
 * @method Periods[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PeriodsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Periods::class);
    }

//    /**
//     * @return Periods[] Returns an array of Periods objects
//     */
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
    public function findOneBySomeField($value): ?Periods
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
     * @return array of all periods
     */
    public function getAllPeriods()
    {
        $periods = [];
        $periodsUnclean =  $this->findAll();

        for($i = 0; $i < count($periodsUnclean); $i++)
        {
            $periods[] = $periodsUnclean[$i]->getPeriod();
        }

        return $periods;
    }
}
