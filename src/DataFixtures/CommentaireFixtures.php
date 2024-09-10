<?php

namespace App\DataFixtures;

use App\Entity\Commentaire;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CommentaireFixtures extends Fixture
{

    public const COMMENTAIRE_REFERENCE = 'Commentaire';

    
    public function load(ObjectManager $manager): void
    {
        $listCommentaires = [
            'commentaire1 SUPER',
            'commentaire2 SUPER',
            'commentaire3 SUPER',
            'commentaire4 NUL',
            'commentaire5 NUL',
            'commentaire6 BOF',
        ];


        foreach ($listCommentaires as $key => $listCommentaire) {
            $commentaire = new Commentaire();
            $commentaire->setContenu($listCommentaire);
            $manager->persist($commentaire);
            $this->addReference(self::COMMENTAIRE_REFERENCE . '_' . $key, $commentaire);
        }

        $manager->flush();
    }
}
