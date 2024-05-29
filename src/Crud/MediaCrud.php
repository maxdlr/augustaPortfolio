<?php

namespace App\Crud;

use App\Crud\Manager\AbstractCrud;
use App\Crud\Manager\CrudSetting;
use App\Entity\Media;
use App\Form\MediaType;
use Exception;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

#[CrudSetting(entity: Media::class, formType: MediaType::class)]
class MediaCrud extends AbstractCrud
{
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