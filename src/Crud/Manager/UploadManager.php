<?php

namespace App\Crud\Manager;

use App\Entity\Media;
use App\Enum\MediaTypeEnum;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
 * @author Maxime de la Rocheterie
 */
class UploadManager extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly SluggerInterface       $slugger
    )
    {
    }

    public function uploadOne(
        FormInterface $form,
        object        $object,
        string $directory = ''
    ): bool
    {
        $uploaded = false;

        try {
            /** @var UploadedFile $mediaFile */
            $mediaFile = $form->get('media')->getData();

            if ($mediaFile) {
                $savedFile = $this->saveFile($mediaFile);

                $object
                    ->setMediaPath('media/' . $directory . $directory !== '' ? '/' : '' . $savedFile['newFilename'])
                    ->setMediaSize($savedFile['fileSize']);
                $uploaded = true;
            }
            return $uploaded;
        } catch (FileException $e) {
            throw new FileException($e);
        }
    }

    public function uploadMany(
        FormInterface $form,
        MediaTypeEnum $mediaType
    ): bool
    {
        $mediaFiles = $form->get('media')->getData();
        $validation = [];

        foreach ($mediaFiles as $mediaFile) {

            if ($mediaFile) {


                $directory = match ($mediaType) {
                    MediaTypeEnum::MOTION => 'motion',
                    MediaTypeEnum::SHOWREEL_THUMBNAIL => 'media',
                    MediaTypeEnum::ILLUSTRATION => 'illustration',
                };

                $savedFile = $this->saveFile($mediaFile, $directory);

                $media = new Media();
                $media
                    ->setMediaPath($directory . '/' . $savedFile['newFilename'])
                    ->setMediaSize($savedFile['fileSize'])
                    ->setType($mediaType);

                $this->entityManager->persist($media);
                $validation[] = true;
            } else {
                $validation[] = false;
            }
        }
        return !in_array(false, $validation);
    }

    public function saveFile(UploadedFile $mediaFile, $directory = 'media'): array
    {
        $originalFilename = pathinfo($mediaFile->getClientOriginalName(), PATHINFO_FILENAME);

        $safeFilename = $this->slugger->slug($originalFilename);
        $newFilename = $safeFilename . '-' . uniqid() . '.' . $mediaFile->guessExtension();
        $fileSize = $mediaFile->getSize();

        try {
            $mediaFile->move(
                $this->getParameter($directory.'_directory'),
                $newFilename
            );
            return ['newFilename' => $newFilename, 'fileSize' => $fileSize];

        } catch (FileException $e) {
            throw new FileException($e);
        }
    }
}