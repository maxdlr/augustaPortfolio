<?php

declare(strict_types=1);

namespace App\Controller;

use App\Crud\Manager\AfterCrudTrait;
use App\Crud\MediaCrud;
use App\Entity\Media;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class MediaController extends AbstractController
{
    use AfterCrudTrait;
    public function __construct(
        private readonly MediaCrud $mediaCrud,
        private readonly EntityManagerInterface $entityManager,
    )
    {
    }

    /**
     * @throws \Exception
     */
    #[Route(path: '/media/{id}/delete', name: 'app_admin_media_delete', methods: ['GET'])]
    public function index(Media $media, Request $request): JsonResponse
    {
        $fileDirectory = dirname(__FILE__, 3) . '/public/build/media/';
        $filePath = $media->getMediaPath();

        if (unlink($fileDirectory . $media->getMediaPath())) {
            $this->entityManager->remove($media);
            $this->entityManager->flush();
        }

        return new JsonResponse(['message' => $filePath . ' est bien supprimé !']);
    }
}
