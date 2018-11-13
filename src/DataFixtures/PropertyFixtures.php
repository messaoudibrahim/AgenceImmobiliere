<?php

namespace App\DataFixtures;

use App\Entity\Property;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PropertyFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 80 ;$i++) {
            $loProperty = new Property();
            $loProperty->setDescription('desciption' . $i);
            $loProperty->setAddress('adressee'. $i);
            $loProperty->setBedroom($i);
            $loProperty->setCity('city' . $i);
            $loProperty->setPostalCode(50000 + $i);
            $loProperty->setRoom($i);
            $loProperty->setPrice(3336+ 40+ $i);
            $loProperty->setFloor($i);
            $loProperty->setTitle('titre de mon bien numero' . $i);
            $loProperty->setSurface($i + 56 );
            $loProperty->setHeat(2);
            $loProperty->setSold(false);
            $manager->persist($loProperty);
        }
        $manager->flush();
    }
}
