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
        $this->makeSpecificMedia('assets/media/showreel_thumbnail', $manager, MediaTypeEnum::SHOWREEL_THUMBNAIL);
        $this->makeSpecificMedia('assets/media/motion', $manager, MediaTypeEnum::MOTION);
        $this->makeSpecificMedia('assets/media/illustration', $manager, MediaTypeEnum::ILLUSTRATION);
        $this->makeSpecificMedia('assets/media/meuf', $manager, MediaTypeEnum::MEUF);
        $this->makeSpecificMedia('assets/media/contact', $manager, MediaTypeEnum::CONTACT);

        $showreelVideo = new Media();

        $showreelVideo
            ->setMediaPath('823390186')
            ->setType(MediaTypeEnum::SHOWREEL_VIDEO)
            ->setMediaSize(0);

        $manager->persist($showreelVideo);
        $manager->flush();
    }

    /**
     * @param string $directory
     * @param ObjectManager $manager
     * @param MediaTypeEnum $mediaTypeEnum
     * @return void
     */
    public function makeSpecificMedia(string $directory, ObjectManager $manager, MediaTypeEnum $mediaTypeEnum): void
    {
        foreach (array_diff(scandir($directory), ['.', '..']) as $media) {
            $mediaPath = str_replace('assets/media/', '', $directory) . '/' . $media;
            $mediaLocation = 'assets/media/' . $mediaPath;

            if (is_file($mediaLocation)) {

                $media = new Media();
                $media
                    ->setMediaPath($mediaPath)
                    ->setMediaSize(filesize($mediaLocation))
                    ->setType($mediaTypeEnum);
            }
            $manager->persist($media);
        }
    }
}
