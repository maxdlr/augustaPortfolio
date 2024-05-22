<?php

namespace App\DataFixtures;

use App\Entity\Media;
use App\Enum\MediaTypeEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MediaFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $showreelThumbnail = new Media();

        $showreelThumbnail
            ->setMediaPath('media/showreel-thumbnail.jpeg')
            ->setMediaSize(filesize('assets/media/showreel-thumbnail.jpeg'))
            ->setType(MediaTypeEnum::SHOWREEL_THUMBNAIL);


        $manager->persist($showreelThumbnail);
        $manager->flush();
    }
}
