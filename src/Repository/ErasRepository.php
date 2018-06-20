<?php

namespace App\Repository;

use App\Entity\Eras;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Eras|null find($id, $lockMode = null, $lockVersion = null)
 * @method Eras|null findOneBy(array $criteria, array $orderBy = null)
 * @method Eras[]    findAll()
 * @method Eras[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ErasRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Eras::class);
    }

//    /**
//     * @return Eras[] Returns an array of Eras objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Eras
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function getAllEras()
    {
        $eras = [];
        $erasUnclean =  $this->findAll();

        for($i = 0; $i < count($erasUnclean); $i++)
        {
            $eras[] = $erasUnclean[$i]->getEra();
        }

        return $eras;
    }
}
