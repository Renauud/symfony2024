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
            'commentaire1',
            'commentaire2',
            'commentaire3',
            'commentaire4',
            'commentaire5',
            'commentaire6',
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
