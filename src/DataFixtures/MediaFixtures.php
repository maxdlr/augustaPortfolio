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


        $manager->flush();
    }

    /**
     * @param string $illustrationImgsDir
     * @param ObjectManager $manager
     * @param MediaTypeEnum $mediaTypeEnum
     * @return void
     */
    private function makeSpecificMedia(string $illustrationImgsDir, ObjectManager $manager, MediaTypeEnum $mediaTypeEnum): void
    {
        $illustrationImgs = [];
        foreach (array_diff(scandir($illustrationImgsDir), ['.', '..']) as $illustrationImg) {
            $illustrationImgPath = str_replace('assets/media/', '', $illustrationImgsDir);
            $illustrationImgs[] = $illustrationImgPath . '/' . $illustrationImg;
        }

        for ($i = 0; $i < count($illustrationImgs); $i++) {
            $media = new Media();
            $media
                ->setMediaPath($illustrationImgs[$i])
                ->setMediaSize(filesize('assets/media/' . $illustrationImgs[$i]))
                ->setType($mediaTypeEnum);

            $manager->persist($media);
        }
    }
}
