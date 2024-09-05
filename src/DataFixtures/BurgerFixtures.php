<?php

namespace App\DataFixtures;

use App\Entity\Burger;
use App\Entity\Pain;
use App\Entity\Sauce;
use App\Entity\Oignon;
use App\Entity\Image;
use App\Entity\Commentaire;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BurgerFixtures extends Fixture
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

        // $commentaire1 = new Commentaire();
        // $commentaire1->setContenu('burgercom1');
        // $manager->persist($commentaire1);

        // $commentaire2 = new Commentaire();
        // $commentaire2->setContenu('burgercom2');
        // $manager->persist($commentaire2);

        // $burger = new Burger();
        // $burger->addCommentaire($commentaire2);
        // $burger->setNom('Burger Spécial');
        // $burger->setPain($pain);
        // $burger->addSauce($sauceBiggy);
        // $burger->addSauce($sauceBlanche);
        // $burger->addOignon($oignon1);
        // $burger->addOignon($oignon2);
        // $burger->setImage($image);
        // $burger->addCommentaire($commentaire1);
        // $burger->addCommentaire($commentaire2);
        
        // $manager->persist($burger);

        $manager->flush();
    }
}
