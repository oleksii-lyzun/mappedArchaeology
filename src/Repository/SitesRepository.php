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

    /**
     * @return array
     */
    public function getAllSitesWithTimes()
    {
        $em = $this->getEntityManager();
        $db = $em->createQueryBuilder();

        $db
            ->select(array('s', 'e', 'p', 'c'))
            ->from('App:Sites', 's')
            ->leftJoin('s.era', 'e')
            ->leftJoin('s.period', 'p')
            ->leftJoin('s.culture', 'c');

        $query = $db->getQuery();
        $result = $query->getResult();

        $resultArray = [];

        /**
         * @param $timeArray
         * @param $time
         * @return array|null
         */
        function getTimesProperly($timeArray, $time)
        {
            $result = [];

            for($i = 0; $i < count($timeArray); $i++)
            {
                switch ($time) {
                    case 'era':
                        $result[] = $timeArray[$i]->getEra();
                        break;
                    case 'period':
                        $result[] = $timeArray[$i]->getPeriod();
                        break;
                    case 'culture':
                        $result[] = $timeArray[$i]->getCulture();
                        break;
                    default:
                        return null;
                }


            }
            return $result;
        }

        /**
         *
         */
        for($i = 0; $i < count($result); $i++)
        {
            $eraToMap = $result[$i]->getEra()->getSnapshot();
            $periodsToMap = $result[$i]->getPeriod()->getSnapshot();
            $culturesToMap = $result[$i]->getCulture()->getSnapshot();

            $resultArray[] = [
                'nameUa' => $result[$i]->getSiteNameUa(),
                'nameEn' => $result[$i]->getSiteNameEn(),
                'descUa' => $result[$i]->getSiteShDescUa(),
                'descEn' => $result[$i]->getSiteShDescEn(),
                'isPublished' => $result[$i]->getIsPublished(),
                'getLatitude' => $result[$i]->getLatitude(),
                'getLongitude' => $result[$i]->getLongitude(),
                'getHeight' => $result[$i]->getHeight(),
                'getEra' => getTimesProperly($eraToMap, 'era'),
                'getPeriod' => getTimesProperly($periodsToMap, 'period'),
                'getCulture' => getTimesProperly($culturesToMap, 'culture'),
            ];
        }

        return $resultArray;
    }
}
