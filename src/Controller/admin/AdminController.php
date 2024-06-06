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
        private readonly UploadManager          $uploadManager,
        private readonly EntityManagerInterface $entityManager,
        private readonly MediaRepository        $mediaRepository,
        private readonly CVItemCrud             $CVItemCrud,
        private readonly CVItemRepository       $CVItemRepository,
        private readonly FormFactoryInterface   $formFactory,
        private readonly MediaCrud              $mediaCrud,
    )
    {
    }

    /**
     * @throws ReflectionException
     */
    #[Route(path: '/', name: 'dashboard', methods: ['GET', 'POST'])]
    public function dashboard(Request $request): Response
    {
        $avatarForm = $this->mediaCrud->mediaSingleUploadForm($request, MediaTypeEnum::AVATAR, 'avatarForm');
        if ($avatarForm === true) return $this->redirectTo('referer', $request);

        $avatarImg = VueDataFormatter::makeVueObjectOf(
            [$this->mediaRepository->findOneBy(['type' => MediaTypeEnum::AVATAR->value])],
            ['id', 'mediaPath', 'mediaSize', 'createdOn', 'type']
        )->getOne();

        $showreelForm = $this->mediaCrud->mediaSingleUploadForm($request, MediaTypeEnum::SHOWREEL_THUMBNAIL, 'showreelThumbnailForm');
        if ($showreelForm === true) return $this->redirectTo('referer', $request);

        $showreelImg = VueDataFormatter::makeVueObjectOf(
            [$this->mediaRepository->findOneBy(['type' => MediaTypeEnum::SHOWREEL_THUMBNAIL->value])],
            ['id', 'mediaPath', 'mediaSize', 'createdOn', 'type']
        )->getOne();

        $meufForm = $this->mediaCrud->mediaSingleUploadForm($request, MediaTypeEnum::MEUF, 'meufForm');
        if ($meufForm === true) return $this->redirectTo('referer', $request);

        $meufImg = VueDataFormatter::makeVueObjectOf(
            [$this->mediaRepository->findOneBy(['type' => MediaTypeEnum::MEUF->value])],
            ['id', 'mediaPath', 'mediaSize', 'createdOn', 'type']
        )->getOne();

        $cursors = $this->mediaRepository->findBy(['type' => MediaTypeEnum::CURSOR->value]);

        $cursorForms = [];
        foreach ($cursors as $cursor) {
            $cursorForms[$cursor->getId()] = $this->mediaCrud->mediaSingleUploadForm(
                $request,
                MediaTypeEnum::CURSOR,
                'form-cursor-' . $cursor->getId(),
                $cursor
            );
        }

        if (in_array(true, $cursorForms, true)) {
            return $this->redirectTo('referer', $request);
        } else {
            $cursorFormViews = array_map(fn(FormInterface $form) => $form->createView(), $cursorForms);
        }

        $cursorImgs = VueDataFormatter::makeVueObjectOf(
            $cursors,
            ['id', 'mediaPath', 'mediaSize', 'createdOn', 'type']
        )->get();

        return $this->render('admin/dashboard.html.twig', [
            'avatarForm' => $avatarForm,
            'avatarImg' => $avatarImg,
            'showreelForm' => $showreelForm,
            'showreelImg' => $showreelImg,
            'meufForm' => $meufForm,
            'meufImg' => $meufImg,
            'cursorImgs' => $cursorImgs,
            'cursorForms' => $cursorFormViews
        ]);
    }

    /**
     * @throws Exception
     */
    #[Route(path: '/CVItem/intervention', name: 'CVItem_intervention', methods: ['GET', 'POST'])]
    public function interventions(Request $request): Response
    {
        $itemsAndForms = $this->CVItemCrud->getCVItemsFormViewAndObjects($request, CVItemTypeEnum::INTERVENTION);
        if ($itemsAndForms === true) return $this->redirectTo('referer', $request);

        return $this->render('admin/cv-item.html.twig', [
            'CVItemForms' => $itemsAndForms['CVItemForms'],
            'newCVItemForm' => $itemsAndForms['newCVItemForm'],
            'CVItems' => $itemsAndForms['CVItems'],
            'entityName' => 'Intervention'
        ]);
    }

    /**
     * @throws Exception
     */
    #[Route(path: '/CVItem/skill', name: 'CVItem_skill', methods: ['GET', 'POST'])]
    public function skills(Request $request): Response
    {
        $itemsAndForms = $this->CVItemCrud->getCVItemsFormViewAndObjects($request, CVItemTypeEnum::SKILL);
        if ($itemsAndForms === true) return $this->redirectTo('referer', $request);

        return $this->render('admin/cv-item.html.twig', [
            'CVItemForms' => $itemsAndForms['CVItemForms'],
            'newCVItemForm' => $itemsAndForms['newCVItemForm'],
            'CVItems' => $itemsAndForms['CVItems'],
            'entityName' => 'Skill'
        ]);
    }

    /**
     * @throws Exception
     */
    #[Route(path: '/CVItem/experience', name: 'CVItem_experience', methods: ['GET', 'POST'])]
    public function experiences(Request $request): Response
    {
        $itemsAndForms = $this->CVItemCrud->getCVItemsFormViewAndObjects($request, CVItemTypeEnum::EXPERIENCE);
        if ($itemsAndForms === true) return $this->redirectTo('referer', $request);

        return $this->render('admin/cv-item.html.twig', [
            'CVItemForms' => $itemsAndForms['CVItemForms'],
            'newCVItemForm' => $itemsAndForms['newCVItemForm'],
            'CVItems' => $itemsAndForms['CVItems'],
            'entityName' => 'Experience'
        ]);
    }

    /**
     * @throws Exception
     */
    #[Route(path: '/motion', name: 'motion', methods: ['GET', 'POST'])]
    public function motion(Request $request): Response
    {
        $motionForm = $this->mediaCrud->mediaUploadForm($request, MediaTypeEnum::MOTION);
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
        $illustrationForm = $this->mediaCrud->mediaUploadForm($request, MediaTypeEnum::ILLUSTRATION);
        if ($illustrationForm === true) return $this->redirectTo('referer', $request);

        $illustrationImgs = VueDataFormatter::makeVueObjectOf($this->mediaRepository->findBy(['type' => MediaTypeEnum::ILLUSTRATION->value]),
            ['id', 'mediaPath', 'mediaSize', 'createdOn', 'type']
        )->get();

        return $this->render('admin/illustration.html.twig', [
            'illustrationForm' => $illustrationForm->createView(),
            'illustrationImgs' => $illustrationImgs
        ]);
    }

    /**
     * @throws Exception
     */
    #[Route(path: '/contact', name: 'contact', methods: ['GET', 'POST'])]
    public function contact(Request $request): Response
    {
        $contactForm = $this->mediaCrud->mediaUploadForm($request, MediaTypeEnum::CONTACT);
        if ($contactForm === true) return $this->redirectTo('referer', $request);

        $contactImgs = VueDataFormatter::makeVueObjectOf($this->mediaRepository->findBy(['type' => MediaTypeEnum::CONTACT->value]),
            ['id', 'mediaPath', 'mediaSize', 'createdOn', 'type']
        )->get();

        return $this->render('admin/contact.html.twig', [
            'contactForm' => $contactForm->createView(),
            'contactImgs' => $contactImgs
        ]);
    }
}