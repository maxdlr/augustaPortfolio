<?php

namespace App\Controller\admin;

use App\Crud\Manager\AfterCrudTrait;
use App\Crud\Manager\UploadManager;
use App\Crud\MediaCrud;
use App\Entity\Media;
use App\Enum\MediaTypeEnum;
use App\Form\MediaType;
use App\Form\SingleMediaType;
use App\Repository\MediaRepository;
use App\Service\VueDataFormatter;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/admin', name: 'app_admin_')]
class AdminController extends AbstractController
{
    use AfterCrudTrait;
    public function __construct(
        private readonly UploadManager $uploadManager,
        private readonly EntityManagerInterface $entityManager,
        private readonly MediaRepository $mediaRepository
    )
    {
    }

    /**
     * @throws \ReflectionException
     */
    #[Route(path: '/', name: 'dashboard', methods: ['GET', 'POST'])]
    public function dashboard(Request $request): Response
    {
        $avatarForm = $this->mediaSingleUploadForm($request, MediaTypeEnum::AVATAR);
        if ($avatarForm === true) return $this->redirectTo('referer', $request);

        $avatarImg = VueDataFormatter::makeVueObjectOf(
            [$this->mediaRepository->findOneBy(['type' => MediaTypeEnum::AVATAR->value])],
            ['id', 'mediaPath', 'mediaSize', 'createdOn', 'type']
        )->getOne();


        return $this->render('admin/dashboard.html.twig', [
            'avatarForm' => $avatarForm,
            'avatarImg' => $avatarImg
        ]);
    }

    /**
     * @throws Exception
     */
    #[Route(path: '/motion', name: 'motion', methods: ['GET', 'POST'])]
    public function motion(Request $request): Response
    {
        $motionForm = $this->mediaUploadForm($request, MediaTypeEnum::MOTION);
        if ($motionForm === true) return $this->redirectTo('referer', $request);

        $motionGifs = VueDataFormatter::makeVueObjectOf($this->mediaRepository->findBy(['type' => MediaTypeEnum::MOTION->value]),
            ['id', 'mediaPath', 'mediaSize', 'createdOn', 'type']
        )->get();

        return $this->render('admin/motion.html.twig', [
            'motionForm' => $motionForm->createView(),
            'motionGifs' => $motionGifs
        ]);
    }

    /**
     * @throws Exception
     */
    #[Route(path: '/illustration', name: 'illustration', methods: ['GET', 'POST'])]
    public function illustration(Request $request): Response
    {
        $illustrationForm = $this->mediaUploadForm($request, MediaTypeEnum::ILLUSTRATION);
        if ($illustrationForm === true) return $this->redirectTo('referer', $request);

        $illustrationImgs = VueDataFormatter::makeVueObjectOf($this->mediaRepository->findBy(['type' => MediaTypeEnum::ILLUSTRATION->value]),
            ['id', 'mediaPath', 'mediaSize', 'createdOn', 'type']
        )->get();

        return $this->render('admin/illustration.html.twig', [
            'illustrationForm' => $illustrationForm->createView(),
            'illustrationImgs' => $illustrationImgs
        ]);
    }

    // -----------------------------------------------------------------------------------------------------------------------------------

    public function mediaUploadForm(Request $request, MediaTypeEnum $mediaType): FormInterface|true
    {
        $mediaForm = $this->createForm(MediaType::class);
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
        $mediaForm = $this->createForm(SingleMediaType::class);
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
}