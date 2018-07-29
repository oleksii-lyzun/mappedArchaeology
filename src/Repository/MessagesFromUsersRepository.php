<?php

namespace App\Repository;

use App\Entity\MessagesFromUsers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MessagesFromUsers|null find($id, $lockMode = null, $lockVersion = null)
 * @method MessagesFromUsers|null findOneBy(array $criteria, array $orderBy = null)
 * @method MessagesFromUsers[]    findAll()
 * @method MessagesFromUsers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MessagesFromUsersRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MessagesFromUsers::class);
    }

//    /**
//     * @return MessagesFromUsers[] Returns an array of MessagesFromUsers objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MessagesFromUsers
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findAllQueryBuilder()
    {
        // createQueryBuilder automatically selects all messages from users
        // alias uses in the rest of the query
        return $this->createQueryBuilder('messages_from_users')
            ->orderBy('messages_from_users.id', 'DESC')
            ->getQuery()
            ->execute();
    }
}
