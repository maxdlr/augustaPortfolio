<?php

namespace App\Crud;

use App\Crud\Manager\AbstractCrud;
use App\Crud\Manager\CrudSetting;
use App\Entity\Media;
use App\Enum\MediaTypeEnum;
use App\Form\MediaType;
use Exception;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[CrudSetting(entity: Media::class, formType: MediaType::class)]
class MediaCrud extends AbstractCrud
{
    /**
     * @throws Exception
     */
    #[Route(path: '/media/{id}/delete', name: 'app_admin_media_delete', methods: ['POST'])]
    public function delete(
        Media $media,
        Request $request
    ): RedirectResponse
    {
        $fileDirectory = match (true) {
          $media->getType() === MediaTypeEnum::MOTION->value => __DIR__ . '/assets/media/motion',
          $media->getType() === MediaTypeEnum::ILLUSTRATION->value => __DIR__ . '/assets/media/illustration',
          $media->getType() === MediaTypeEnum::SHOWREEL_THUMBNAIL->value => __DIR__ . '/assets/media'
        };
        dd($fileDirectory);
        exec('rm ' . $fileDirectory . $media->getMediaPath());
        return $this->deleteManager->delete($request, $media, 'app_admin_motion', []);
    }
}