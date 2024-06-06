<?php

namespace App\Crud\Manager;

use App\Entity\Media;
use App\Enum\MediaTypeEnum;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;
use function Symfony\Component\String\u;

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
        Media         $object,
        MediaTypeEnum $mediaType,
    ): bool
    {
        $uploaded = false;

        try {
            /** @var UploadedFile $mediaFile */
            $mediaFile = $form->get('media')->getData();

            if ($mediaFile) {
                $directory = u($mediaType->value)->lower();
                $savedFile = $this->saveFile($mediaFile, $directory, $mediaType, $object);

                $object
                    ->setMediaPath($directory . '/' . $savedFile['newFilename'])
                    ->setMediaSize($savedFile['fileSize'])
                    ->setType($mediaType);

                $uploaded = true;
            }
            return $uploaded;
        } catch (FileException $e) {
            throw new FileException($e);
        }
    }

    /**
     * @throws Exception
     */
    public function saveFile(UploadedFile $mediaFile, $directory = 'media', ?MediaTypeEnum $mediaType = null, ?Media $existingMedia = null): array
    {
        if ($mediaType === MediaTypeEnum::CURSOR && $existingMedia === null)
            throw new Exception('Need existing file to save for cursors');

        $originalFilename = pathinfo($mediaFile->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);

        $newFilename = match ($mediaType) {
            MediaTypeEnum::CURSOR => str_replace('cursor/', '', $existingMedia->getMediaPath()),
            default => $safeFilename . '-' . uniqid() . '.' . $mediaFile->guessExtension()
        };

        $fileSize = $mediaFile->getSize();

        try {
            $mediaFile->move(
                $this->getParameter($directory . '_directory'),
                $newFilename
            );
            return ['newFilename' => $newFilename, 'fileSize' => $fileSize];

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
        $directory = $mediaType->value;
        $validation = [];

        foreach ($mediaFiles as $mediaFile) {
            if ($mediaFile) {
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
}