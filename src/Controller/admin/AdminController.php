<?php

namespace App\Controller\admin;

use App\Crud\Manager\AfterCrudTrait;
use App\Crud\Manager\UploadManager;
use App\Crud\MediaCrud;
use App\Entity\Media;
use App\Enum\MediaTypeEnum;
use App\Form\MediaType;
use App\Repository\MediaRepository;
use App\Service\VueDataFormatter;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

    #[Route(path: '/', name: 'dashboard', methods: ['GET', 'POST'])]
    public function dashboard(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    /**
     * @throws Exception
     */
    #[Route(path: '/motion', name: 'motion', methods: ['GET', 'POST'])]
    public function motion(Request $request): Response
    {
        $mediaForm = $this->createForm(MediaType::class);
        $mediaForm->handleRequest($request);

        if ($mediaForm->isSubmitted() && $mediaForm->isValid()) {
            $this->uploadManager->uploadMany($mediaForm, MediaTypeEnum::MOTION);
            $this->entityManager->flush();
            return $this->redirectTo('referer', $request);
        }

        $motionMediaData = VueDataFormatter::makeVueObjectOf($this->mediaRepository->findBy(['type' => MediaTypeEnum::MOTION->value]),
            ['id', 'mediaPath', 'mediaSize', 'createdOn', 'type']
        )->get();

        return $this->render('admin/motion.html.twig', [
            'mediaForm' => $mediaForm->createView(),
            'motionMedia' => $motionMediaData
        ]);
    }
}