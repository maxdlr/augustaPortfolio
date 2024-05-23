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

        $motionGifsDir = 'assets/media/motion';

        $motionGifs = [];
        foreach (array_diff(scandir($motionGifsDir), ['.', '..']) as $motionGif) {
            $motionGifPath = str_replace('assets/media/', '', $motionGifsDir);
            $motionGifs[] = $motionGifPath . '/' . $motionGif;
        }

        for ($i = 0; $i < count($motionGifs); $i++) {
            $media = new Media();
            $media
                ->setMediaPath($motionGifs[$i])
                ->setMediaSize(filesize('assets/media/' . $motionGifs[$i]))
                ->setType(MediaTypeEnum::MOTION)
            ;

            $manager->persist($media);
        }


        $manager->flush();
    }
}
