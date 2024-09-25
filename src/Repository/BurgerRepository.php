<?php

namespace App\Repository;

use App\Entity\Burger;
use App\Entity\Oignon;
use App\Entity\Pain;
use App\Entity\Sauce;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityRepository;
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

    public function listBurgerNames(){

        $query = $this->createQueryBuilder("b") // requête pour l'affichage des burgers à la route "/burgers"
        ->select('b.nom, b.price, b.image');

        $query = $query->getQuery();

        return $query->getResult();
    }

    public function findBurgerWithIngredient(Pain | Oignon | Sauce $ingredient){

        $ingredientType = get_class($ingredient);

        $query = $this->createQueryBuilder('b');
        if($ingredientType == "App\Entity\Sauce"){
            $query->leftJoin("b.sauce", "s")
            ->where("s.id = :ingredientId")
            ->setParameter("ingredientId",$ingredient->getId());
        }elseif($ingredientType == "App\Entity\Pain"){
            $query->leftJoin("b.pain", "p")
            ->where("p.id = :ingredientId")
            ->setParameter("ingredientId",$ingredient->getId());
        }else{
            $query->leftJoin("b.oignon", "o")
            ->where("o.id = :ingredientId")
            ->setParameter("ingredientId",$ingredient->getId());
        }

        $query = $query->getQuery();

        return $query->execute();
    }

    public function findBurgerWithoutIngredient(string $ingredientType, int $ingredientId){

        //pb qd le burger contient plusieurs sauces
        $query = $this->createQueryBuilder('b')
        ->leftJoin("b." . $ingredientType, "i")
        ->where("b.id NOT IN (
                SELECT b2.id
                FROM App\Entity\Burger b2
                JOIN b2." . $ingredientType . " i2
                WHERE i2.id = :ingredientId)
                ")
        ->setParameter("ingredientId", $ingredientId);

        $query = $query->getQuery();

        return $query->getResult();
    }

    public function findTopXMostExpensiveBurger(int $limit){

        $query = $this->createQueryBuilder('b')
        ->orderBy('b.price', 'DESC')
        ->setMaxResults($limit);

        $query = $query->getQuery();

        return $query->execute();
    }

    public function findBurgersWithMinimumIngredients(int $minIngredients){

        $query = $this->createQueryBuilder("b")
        ->leftJoin('b.sauce', 's')
        ->leftJoin('b.oignon', 'o')
        ->groupBy('b.id')
        ->having('(COUNT(s) + COUNT(o))+1 >= :minIngredients') // le +1 est lié au pain, qui est toujours présent 
        ->setParameter('minIngredients', $minIngredients);

        $query = $query->getQuery();

       return $query->execute();
    }

    public function imagesNotLinked(){

        $query = $this->createQueryBuilder("");
    }


    // public function getNameFromId(){
        
    //     $query = $entityManager->createQueryBuilder("")
    //     ->select($name . ".nom")
    //     ->where($name . ".id = :id")
    //     ->setParameter("id", $id);

    //     $query = $query->getQuery();

    //     return $query->getSingleScalarResult();
    // }

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
