<?php

namespace App\DataFixtures;

use App\Entity\Oignon;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OignonFixtures extends Fixture
{

    public const OIGNON_REFERENCE = 'Oignon';

    public function load(ObjectManager $manager): void
    {

        $listOignons = [
            'oignons jaunes',
            'oignons rouges',
            'oignons caramélisés'
        ];

        foreach ($listOignons as $key => $listOignon) {
            $oignon = new Oignon();
            $oignon->setNom($listOignon);
            $manager->persist($oignon);
            $this->addReference(self::OIGNON_REFERENCE . '_' . $key, $oignon);
        }

        $manager->flush();
    }
}
