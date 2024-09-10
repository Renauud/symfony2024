<?php

namespace App\DataFixtures;

use App\Entity\Burger;
use App\Entity\Pain;
use App\Entity\Sauce;
use App\Entity\Oignon;
use App\Entity\Image;
use App\Entity\Commentaire;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class BurgerFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $sauceBlanche = $this->getReference(SauceFixtures::SAUCE_REFERENCE . '_0');
        $sauceMayonnaise = $this->getReference(SauceFixtures::SAUCE_REFERENCE . '_1');
        $sauceKetchup = $this->getReference(SauceFixtures::SAUCE_REFERENCE . '_2');
        $sauceBarbecue = $this->getReference(SauceFixtures::SAUCE_REFERENCE . '_3');
        $sauceBiggy = $this->getReference(SauceFixtures::SAUCE_REFERENCE . '_4');
        $sauceAndalouse = $this->getReference(SauceFixtures::SAUCE_REFERENCE . '_5');

        $painBurgerBrioche = $this->getReference(PainFixtures::PAIN_REFERENCE . '_0');
        $painBurgerSesame = $this->getReference(PainFixtures::PAIN_REFERENCE . '_1');
        $painBurgerClassique = $this->getReference(PainFixtures::PAIN_REFERENCE . '_2');

        $oignonsJaunes = $this->getReference(OignonFixtures::OIGNON_REFERENCE . '_0');
        $oignonsRouges = $this->getReference(OignonFixtures::OIGNON_REFERENCE . '_1');
        $oignonsCaramelises = $this->getReference(OignonFixtures::OIGNON_REFERENCE . '_2');

        $imageBurger1 = $this->getReference(ImageFixtures::IMAGE_REFERENCE . '_0');
        $imageBurger2 = $this->getReference(ImageFixtures::IMAGE_REFERENCE . '_1');
        $imageBurger3 = $this->getReference(ImageFixtures::IMAGE_REFERENCE . '_2');

        $commentaire1 = $this->getReference(CommentaireFixtures::COMMENTAIRE_REFERENCE . '_0');
        $commentaire2 = $this->getReference(CommentaireFixtures::COMMENTAIRE_REFERENCE . '_1');
        $commentaire3 = $this->getReference(CommentaireFixtures::COMMENTAIRE_REFERENCE . '_2');
        $commentaire4 = $this->getReference(CommentaireFixtures::COMMENTAIRE_REFERENCE . '_3');
        $commentaire5 = $this->getReference(CommentaireFixtures::COMMENTAIRE_REFERENCE . '_4');
        $commentaire6 = $this->getReference(CommentaireFixtures::COMMENTAIRE_REFERENCE . '_5');


        //Meilleur Burger
        $burgerSuperbe = new Burger();
        $burgerSuperbe->setNom('Burger Super');
        $burgerSuperbe->setPain($painBurgerBrioche);
        $burgerSuperbe->addSauce($sauceBiggy);
        $burgerSuperbe->addSauce($sauceBlanche);
        $burgerSuperbe->addOignon($oignonsCaramelises);
        $burgerSuperbe->addOignon($oignonsCaramelises);
        $burgerSuperbe->setImage($imageBurger1);
        $burgerSuperbe->addCommentaire($commentaire1);
        $burgerSuperbe->addCommentaire($commentaire2);
        $burgerSuperbe->addCommentaire($commentaire3);

        //Mid Burger
        $burgerMid = new Burger();
        $burgerMid->setNom('Burger Mid');
        $burgerMid->setPain($painBurgerSesame);
        $burgerMid->addSauce($sauceMayonnaise);
        $burgerMid->setImage($imageBurger2);
        $burgerMid->addCommentaire($commentaire6);
        
        //Pire Burger
        $burgerNul = new Burger();
        $burgerNul->setNom('Burger Nul');
        $burgerNul->setPain($painBurgerClassique);
        $burgerNul->addSauce($sauceKetchup);
        $burgerNul->setImage($imageBurger3);
        $burgerNul->addCommentaire($commentaire4);
        $burgerNul->addCommentaire($commentaire5);

        
        $manager->persist($burgerSuperbe);
        $manager->persist($burgerNul);
        $manager->persist($burgerMid);

        $manager->flush();
    }

    public function getDependencies(){
        return [
            SauceFixtures::class,
            PainFixtures::class,
            OignonFixtures::class,
            ImageFixtures::class,
            CommentaireFixtures::class
        ];
    }
    
}
