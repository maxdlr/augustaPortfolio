<?php

namespace App\Crud;

use App\Crud\Manager\AbstractCrud;
use App\Crud\Manager\CrudSetting;
use App\Crud\Manager\DeleteManager;
use App\Crud\Manager\SaveManager;
use App\Crud\Manager\UploadManager;
use App\Entity\Media;
use App\Enum\MediaTypeEnum;
use App\Form\MediaType;
use App\Form\SingleMediaType;
use App\Repository\MediaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

#[CrudSetting(entity: Media::class, formType: MediaType::class)]
class MediaCrud extends AbstractCrud
{
    public function __construct(
        SaveManager                             $saveManager,
        DeleteManager                           $deleteManager,
        UploadManager                           $uploadManager,
        private readonly EntityManagerInterface $entityManager,
        private readonly FormFactoryInterface   $formFactory,
        private readonly MediaRepository        $mediaRepository
    )
    {
        parent::__construct($saveManager, $deleteManager, $uploadManager);
    }

    public function mediaUploadForm(Request $request, MediaTypeEnum $mediaType): FormInterface|true
    {
        $mediaForm = $this->formFactory->create(MediaType::class);
        $mediaForm->handleRequest($request);

        if ($mediaForm->isSubmitted() && $mediaForm->isValid()) {
            $this->uploadManager->uploadMany($mediaForm, $mediaType);
            $this->entityManager->flush();
            return true;
        }

        return $mediaForm;
    }

    public function mediaSingleUploadForm(Request $request, MediaTypeEnum $mediaType): FormInterface|true
    {
        $mediaForm = $this->formFactory->create(SingleMediaType::class);
        $mediaForm->handleRequest($request);

        if ($mediaForm->isSubmitted() && $mediaForm->isValid()) {

            if ($mediaType === MediaTypeEnum::AVATAR) {
                $fetchedAvatar = $this->mediaRepository->findOneBy(['type' => $mediaType]);
                $media = is_null($fetchedAvatar) ? new Media() : $fetchedAvatar;
            } else {
                $media = new Media();
            }

            if ($this->uploadManager->uploadOne($mediaForm, $media, $mediaType) === true) $this->entityManager->persist($media);
            $this->entityManager->flush();
            return true;
        }

        return $mediaForm;
    }

    /**
     * @throws Exception
     */
    public function delete(
        Media   $media,
        Request $request
    ): RedirectResponse
    {
        return $this->deleteManager->delete($request, $media, 'app_admin_motion', []);
    }
}