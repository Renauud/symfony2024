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

        $pain = $this->getReference(PainFixtures::PAIN_REFERENCE . '_0');
        $oignon1 = $this->getReference(OignonFixtures::OIGNON_REFERENCE . '_0');
        $oignon2 = $this->getReference(OignonFixtures::OIGNON_REFERENCE . '_1');

        // $image = new Image();
        // $image->setUrl('');
        // $image->setAltText('burgerimg1');
        // $manager->persist($image);

        // $commentaire1 = new Commentaire();
        // $commentaire1->setContenu('burgercom1');
        // $manager->persist($commentaire1);

        // $commentaire2 = new Commentaire();
        // $commentaire2->setContenu('burgercom2');
        // $manager->persist($commentaire2);

        // $burger = new Burger();
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
