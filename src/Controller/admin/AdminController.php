<?php

namespace App\Controller\admin;

use App\Crud\CVItemCrud;
use App\Crud\Manager\AfterCrudTrait;
use App\Crud\Manager\UploadManager;
use App\Crud\MediaCrud;
use App\Entity\CVItem;
use App\Entity\Media;
use App\Enum\CVItemTypeEnum;
use App\Enum\MediaTypeEnum;
use App\Form\CVItemType;
use App\Form\MediaType;
use App\Form\SingleMediaType;
use App\Repository\CVItemRepository;
use App\Repository\MediaRepository;
use App\Service\VueDataFormatter;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use ReflectionException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
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
        private readonly MediaRepository $mediaRepository,
        private readonly CVItemCrud $CVItemCrud,
        private readonly CVItemRepository $CVItemRepository,
        private readonly FormFactoryInterface $formFactory
    )
    {
    }

    /**
     * @throws ReflectionException
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
    #[Route(path: '/CVItem/intervention', name: 'CVItem_intervention', methods: ['GET', 'POST'])]
    public function CVItem(Request $request): Response
    {
        $CVItemObjects = $this->CVItemRepository->findBy(['type' => CVItemTypeEnum::INTERVENTION->value]);

        $CVItems = VueDataFormatter::makeVueObjectOf($CVItemObjects,
        [
            'id',
            'type',
            'title',
            'labelLink',
            'link',
            'description'
        ])->get();

        $CVItemForms = [];
        foreach ($CVItemObjects as $CVItem) {
            $CVItemForms[$CVItem->getId()] = $this->formFactory
                ->createNamed('form-CVItem-'.$CVItem->getId(), CVItemType::class, $CVItem);
        }

        $CVItemFormViews = array_map(fn(FormInterface $form) => $form->createView(), $CVItemForms);

        foreach ($CVItemForms as $CVItemForm) {
            if ($CVItemForm->isSubmitted() && $CVItemForm->isValid()) {
                $CVItem = $this->CVItemRepository->findOneById(str_replace('form-CVItem-', '', $CVItemForm->getName()));
                dd($CVItem);
                $this->entityManager->persist($CVItem);
                $this->entityManager->flush();
                return $this->redirectTo('referer', $request);
            }
        }

        $newCVItem = new CVItem();
        $newCVItemForm = $this->CVItemCrud->save($request, $newCVItem, [], function () use ($newCVItem) {
            $newCVItem->setType(CVItemTypeEnum::INTERVENTION);
        });

        if ($newCVItemForm === true) return $this->redirectTo('referer', $request);

        return $this->render('admin/intervention.html.twig', [
            'CVItemForms' => $CVItemFormViews,
            'newCVItemForm' => $newCVItemForm,
            'CVItems' => $CVItems
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