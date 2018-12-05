<?php

namespace App\Repository;

use App\Entity\Contenu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Contenu|null find($id, $lockMode = null, $lockVersion = null)
 * @method Contenu|null findOneBy(array $criteria, array $orderBy = null)
 * @method Contenu[]    findAll()
 * @method Contenu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContenuRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Contenu::class);
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('c')
            ->where('c.something = :value')->setParameter('value', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
