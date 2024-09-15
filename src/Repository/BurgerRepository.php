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

    public function findBurgerWithIngredient(string $ingredientType, int $ingredientId){

        $query = $this->createQueryBuilder('b')
        ->leftJoin("b." . $ingredientType, "i")
        ->where("i.id = :ingredientId")
        ->setParameter("ingredientId", $ingredientId);

        $query = $query->getQuery();

        return $query->execute();
    }

    public function findBurgerWithoutIngredient(string $ingredientType, int $ingredientId){

        $query = $this->createQueryBuilder('b')
        ->leftJoin("b." . $ingredientType, "i")
        ->where("i.id IS NULL OR i.id != :ingredientId")
        ->setParameter("ingredientId", $ingredientId);

        $query = $query->getQuery();

        return $query->execute();
    }

    public function findTopXMostExpensiveBurger(int $limit){

        $query = $this->createQueryBuilder('b')
        ->orderBy('b.price', 'DESC')
        ->setMaxResults($limit);

        $query = $query->getQuery();

        return $query->execute();
}

        //FAIRE UNE FONCTION QUI ME PERMET DE RECUPERER LE NOM AVEC L'ID POUR DE L'AFFICHAGE
        // PROBLEME : IL FAUT ACCEDER A CAHQUE REPOSITORY DE CHAQUE INGREDIENT POSSIBLE?
    // public function getNameFromId(int $id): ?string{

    //     $query = $this->createQueryBuilder('i')
    //     ->select('i.nom')
    //     ->where('i.id = :id')
    //     ->setParameter('id', $id);

    //     $query = $query->getQuery();

    //     return $query->getSingleScalarResult();
    // }

    // public function findBurgerWithSauce(Sauce $sauce): array{

    //     $query= $this->createQueryBuilder('b')
    //     ->leftJoin("b.sauce", "s")
    //     ->where("s.id = :sauce")
    //     ->setParameter("sauce", $sauce->getId());

    //     $query = $query->getQuery();

    //     return $query->execute();
    // }

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
