<?php

namespace App\DataFixtures;

use App\Entity\Image;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ImageFixtures extends Fixture
{

    public const IMAGE_REFERENCE = 'Image';

    public function load(ObjectManager $manager)
    {

        $imagesData =
        [
            ['url' => 'https://www.google.com/imgres?q=burger&imgurl=https%3A%2F%2Fvacheburger.fr%2Fwp-content%2Fuploads%2F2022%2F11%2Fvache-burger-nancy-restaurant-livraison-emporter-buffala.webp&imgrefurl=https%3A%2F%2Fvacheburger.fr%2F&docid=0MxbP6g2nci_DM&tbnid=iVEBTsYt3q-RnM&vet=12ahUKEwjA0brkoquIAxW9TqQEHQ2YAGAQM3oECFIQAA..i&w=1000&h=1000&hcb=2&ved=2ahUKEwjA0brkoquIAxW9TqQEHQ2YAGAQM3oECFIQAA', 'altText' => 'burger1a'],
            ['url' => 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.epicurious.com%2Frecipes%2Ffood%2Fviews%2Fclassic-smashed-cheeseburger-51261810&psig=AOvVaw0M28c2DGwXDA1NxvdvVNjn&ust=1725607440046000&source=images&cd=vfe&opi=89978449&ved=0CBIQjRxqFwoTCPDV3I6jq4gDFQAAAAAdAAAAABAE', 'altText' => 'burger2b'],
            ['url' => 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.biofournil.com%2Fle-blog%2Fvos-recettes%2Frecette-burgers-brioches-gourmand%2F&psig=AOvVaw0M28c2DGwXDA1NxvdvVNjn&ust=1725607440046000&source=images&cd=vfe&opi=89978449&ved=0CBIQjRxqFwoTCPDV3I6jq4gDFQAAAAAdAAAAABAJ', 'altText' => 'burger3c'],
            ['url' => 'https://www.socopa.fr/wp-content/uploads/2023/05/bao-burger-1.jpg', 'altText' => ''],
            ['url' => 'https://static.vecteezy.com/ti/photos-gratuite/p1/19023604-vue-de-face-burger-de-viande-savoureux-avec-fromage-et-salade-gratuit-photo.jpg', 'altText' => 'imgNv'],
            ['url' => 'https://plus.unsplash.com/premium_photo-1683619761468-b06992704398?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8YnVyZ2VyfGVufDB8fDB8fHww', 'altText' => 'IMGTEST1'],
            ['url' => 'https://plus.unsplash.com/premium_photo-1683619761468-b06992704398?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8YnVyZ2VyfGVufDB8fDB8fHww', 'altText' => 'IMGTEST2'],
            ['url' => 'https://plus.unsplash.com/premium_photo-1683619761468-b06992704398?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8YnVyZ2VyfGVufDB8fDB8fHww', 'altText' => 'IMGTEST3'],
            ['url' => 'https://plus.unsplash.com/premium_photo-1683619761468-b06992704398?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8YnVyZ2VyfGVufDB8fDB8fHww', 'altText' => 'IMGTEST4'],
            ['url' => 'https://plus.unsplash.com/premium_photo-1683619761468-b06992704398?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8YnVyZ2VyfGVufDB8fDB8fHww', 'altText' => 'IMGTEST5'],
            ['url' => 'https://plus.unsplash.com/premium_photo-1683619761468-b06992704398?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8YnVyZ2VyfGVufDB8fDB8fHww', 'altText' => 'IMGTEST6'],
            ['url' => 'https://plus.unsplash.com/premium_photo-1683619761468-b06992704398?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8YnVyZ2VyfGVufDB8fDB8fHww', 'altText' => 'IMGTEST7'],
            ['url' => 'https://plus.unsplash.com/premium_photo-1683619761468-b06992704398?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8YnVyZ2VyfGVufDB8fDB8fHww', 'altText' => 'IMGTEST8'],
            ['url' => 'https://plus.unsplash.com/premium_photo-1683619761468-b06992704398?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8YnVyZ2VyfGVufDB8fDB8fHww', 'altText' => 'IMGTEST9'],
            ['url' => 'https://plus.unsplash.com/premium_photo-1683619761468-b06992704398?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8YnVyZ2VyfGVufDB8fDB8fHww', 'altText' => 'IMGTEST10'],
            ['url' => 'https://plus.unsplash.com/premium_photo-1683619761468-b06992704398?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8YnVyZ2VyfGVufDB8fDB8fHww', 'altText' => 'IMGTEST11'],
            ['url' => 'https://plus.unsplash.com/premium_photo-1683619761468-b06992704398?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8YnVyZ2VyfGVufDB8fDB8fHww', 'altText' => 'IMGTEST12'],
            ['url' => 'https://plus.unsplash.com/premium_photo-1683619761468-b06992704398?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8YnVyZ2VyfGVufDB8fDB8fHww', 'altText' => 'IMGTEST13'],
        ];
        
        foreach ($imagesData as $key => $imageData) {
            $image = new Image();
            $image->setUrl($imageData['url']);
            $image->setAltText($imageData["altText"]);
            $manager->persist($image);
            $this->addReference(self::IMAGE_REFERENCE . '_' . $key, $image);
        }

        $manager->flush();
    }
}
