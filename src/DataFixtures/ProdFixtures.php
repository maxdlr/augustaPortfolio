<?php

namespace App\DataFixtures;

use App\Entity\Media;
use App\Entity\User;
use App\Enum\MediaTypeEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ProdFixtures extends Fixture
{
    public function __construct(private readonly UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $plaintextPassword = 'P@sse00556632';

        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            $plaintextPassword
        );
        $user->setPassword($hashedPassword);

        $user
            ->setRoles(['ROLE_ADMIN'])
            ->setEmail('augusta@qimono.tv')
            ->setPassword($hashedPassword);

        $manager->persist($user);

        $this->makeSpecificMedia('assets/media/cursor', $manager, MediaTypeEnum::CURSOR);

        $manager->flush();
    }

    private function makeSpecificMedia(string $directory, ObjectManager $manager, MediaTypeEnum $mediaTypeEnum): void
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
