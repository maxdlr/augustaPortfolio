<?php

namespace App\DataFixtures;

use App\Entity\CVItem;
use App\Enum\CVItemTypeEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CVItemFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 20; $i++) {
            $item = new CVItem();

            $item
                ->setType($faker->randomElement(CVItemTypeEnum::cases()))
                ->setDescription($faker->paragraph())
                ->setLink($faker->url())
                ->setLinkLabel($faker->word())
                ->setTitle($faker->words(asText: true));

            $manager->persist($item);
        }

        $manager->flush();
    }
}
