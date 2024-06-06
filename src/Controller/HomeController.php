<?php

namespace App\Controller;

use App\Enum\CVItemTypeEnum;
use App\Enum\MediaTypeEnum;
use App\Repository\CVItemRepository;
use App\Repository\MediaRepository;
use App\Service\VueDataFormatter;
use ReflectionException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    public function __construct(
        private readonly MediaRepository  $mediaRepository,
        private readonly CVItemRepository $CVItemRepository
    )
    {
    }

    /**
     * @throws ReflectionException
     */
    #[Route(path: '/', name: 'app_home', methods: ['POST', 'GET'])]
    public function index(): Response
    {
        $showreelThumbnailPath = $this->mediaRepository->findOneBy(['type' => MediaTypeEnum::SHOWREEL_THUMBNAIL->value])?->getMediaPath();
        $motionGifsData = VueDataFormatter::makeVueObjectOf(
            $this->mediaRepository->findBy(['type' => MediaTypeEnum::MOTION->value]),
            ['id', 'mediaPath', 'mediaSize', 'createdOn', 'type']
        )->get();
        $illustrationImgsData = VueDataFormatter::makeVueObjectOf(
            $this->mediaRepository->findBy(['type' => MediaTypeEnum::ILLUSTRATION->value]),
            ['id', 'mediaPath', 'mediaSize', 'createdOn', 'type']
        )->get();
        $avatarImg = VueDataFormatter::makeVueObjectOf(
            [$this->mediaRepository->findOneBy(['type' => MediaTypeEnum::AVATAR->value])],
            ['id', 'mediaPath', 'mediaSize', 'createdOn', 'type']
        )->getOne();
        $interventions = VueDataFormatter::makeVueObjectOf(
            $this->CVItemRepository->findBy(['type' => CVItemTypeEnum::INTERVENTION->value]),
            ['id', 'type', 'title', 'labelLink', 'link', 'description']
        )->get();
        $experiences = VueDataFormatter::makeVueObjectOf(
            $this->CVItemRepository->findBy(['type' => CVItemTypeEnum::EXPERIENCE->value]),
            ['id', 'type', 'title', 'labelLink', 'link', 'description']
        )->get();
        $skills = VueDataFormatter::makeVueObjectOf(
            $this->CVItemRepository->findBy(['type' => CVItemTypeEnum::SKILL->value]),
            ['id', 'type', 'title', 'labelLink', 'link', 'description']
        )->get();
        $meuf = VueDataFormatter::makeVueObjectOf(
            [$this->mediaRepository->findOneBy(['type' => MediaTypeEnum::MEUF->value])],
            ['id', 'mediaPath', 'mediaSize', 'createdOn', 'type']
        )->getOne();
        $contactImgs = VueDataFormatter::makeVueObjectOf(
            $this->mediaRepository->findBy(['type' => MediaTypeEnum::CONTACT->value]),
            ['id', 'mediaPath', 'mediaSize', 'createdOn', 'type']
        )->get();

        return $this->render('pages/home.html.twig', [
            'showreelThumbnailPath' => $showreelThumbnailPath,
            'motionGifsData' => $motionGifsData,
            'illustrationImgsData' => $illustrationImgsData,
            'avatarImg' => $avatarImg,
            'interventions' => $interventions,
            'experiences' => $experiences,
            'skills' => $skills,
            'meuf' => $meuf,
            'contactImgs' => $contactImgs
        ]);
    }
}