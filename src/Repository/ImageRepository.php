<?php

namespace App\Repository;

use App\Entity\Image;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Image>
 */
class ImageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Image::class);
    }

    
    public function imagesNotUsed(){

        $query = $this->createQueryBuilder("i")
        ->leftJoin('App\Entity\Burger', 'b', 'WITH', 'b.image = i.id')
        ->where('b.id IS NULL'
        );



        $query= $query->getQuery();

        return $query->execute();
    }
}
