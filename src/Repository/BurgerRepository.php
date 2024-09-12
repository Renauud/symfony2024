<?php

namespace App\Repository;

use App\Entity\Burger;
use App\Entity\Oignon;
use App\Entity\Pain;
use App\Entity\Sauce;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Burger>
 */
class BurgerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Burger::class);
    }

    public function findBurgerWithIngredient(Entity $ingredient){

        $query= $this->createQueryBuilder('b')
        ->leftJoin("b." . $ingredient, "i")
        ->where("i.id = :ingredient")
        ->setParameter("ingredient", $ingredient);

        $query = $query->getQuery();

        return $query->execute();
    }

    public function findBurgerWithSauce(Sauce $sauce): array{

        $query= $this->createQueryBuilder('b')
        ->leftJoin("b.sauce", "s")
        ->where("s.id = :sauce")
        ->setParameter("sauce", $sauce->getId());

        $query = $query->getQuery();

        return $query->execute();
    }

    //    /**
    //     * @return Burger[] Returns an array of Burger objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('b.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Burger
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
