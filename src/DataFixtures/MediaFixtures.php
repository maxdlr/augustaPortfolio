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

        $this->makeSpecificMedia('assets/media/motion', $manager, MediaTypeEnum::MOTION);
        $this->makeSpecificMedia('assets/media/illustration', $manager, MediaTypeEnum::ILLUSTRATION);
        $this->makeSpecificMedia('assets/media/meuf', $manager, MediaTypeEnum::MEUF);


        $manager->flush();
    }

    /**
     * @param string $illustrationImgsDir
     * @param ObjectManager $manager
     * @param MediaTypeEnum $mediaTypeEnum
     * @return void
     */
    private function makeSpecificMedia(string $directory, ObjectManager $manager, MediaTypeEnum $mediaTypeEnum): void
    {
        $medias = [];
        foreach (array_diff(scandir($directory), ['.', '..']) as $media) {
            $mediaPath = str_replace('assets/media/', '', $directory);
            $medias[] = $mediaPath . '/' . $media;
        }

        for ($i = 0; $i < count($medias); $i++) {
            $media = new Media();
            $media
                ->setMediaPath($medias[$i])
                ->setMediaSize(filesize('assets/media/' . $medias[$i]))
                ->setType($mediaTypeEnum);

            $manager->persist($media);
        }
    }
}
