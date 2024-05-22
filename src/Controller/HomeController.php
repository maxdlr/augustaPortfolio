<?php

namespace App\Controller;

use App\Enum\MediaTypeEnum;
use App\Repository\MediaRepository;
use App\Service\VueDataFormatter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    public function __construct(
        private readonly MediaRepository $mediaRepository
    )
    {
    }

    /**
     * @throws \ReflectionException
     */
    #[Route(path: '/', name: 'app_home', methods: ['POST', 'GET'])]
    public function index(): Response
    {
        $showreelThumbnailPath = $this->mediaRepository->findOneBy(['mediaPath' => 'media/showreel-thumbnail.jpeg'])->getMediaPath();
        $motionGifsData = VueDataFormatter::makeVueObjectOf($this->mediaRepository->findBy(['type' => MediaTypeEnum::MOTION->value], null, 6),
            ['id', 'mediaPath', 'mediaSize', 'createdOn', 'type']
        )->get();

        return $this->render('pages/home.html.twig', [
            'showreelThumbnailPath' => $showreelThumbnailPath,
            'motionGifsData' => $motionGifsData
        ]);
    }
}