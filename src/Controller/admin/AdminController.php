<?php

namespace App\Controller\admin;

use App\Crud\CVItemCrud;
use App\Crud\Manager\AfterCrudTrait;
use App\Crud\Manager\UploadManager;
use App\Crud\MediaCrud;
use App\Crud\SocialItemCrud;
use App\Entity\Media;
use App\Entity\SocialItem;
use App\Entity\WebsiteConfig;
use App\Enum\CVItemTypeEnum;
use App\Enum\MediaTypeEnum;
use App\Enum\SeoDefaultsEnum;
use App\Form\ShowreelVideoType;
use App\Form\SocialItemType;
use App\Form\WebsiteConfigType;
use App\Repository\CVItemRepository;
use App\Repository\MediaRepository;
use App\Repository\SocialItemRepository;
use App\Repository\WebsiteConfigRepository;
use App\Seo\Seo;
use App\Service\VueDataFormatter;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use ReflectionException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route(path: '/admin', name: 'app_admin_')]
#[IsGranted('ROLE_ADMIN')]
class AdminController extends AbstractController
{
    use AfterCrudTrait;

    public function __construct(
        private readonly UploadManager           $uploadManager,
        private readonly EntityManagerInterface  $entityManager,
        private readonly MediaRepository         $mediaRepository,
        private readonly CVItemCrud              $CVItemCrud,
        private readonly CVItemRepository        $CVItemRepository,
        private readonly FormFactoryInterface    $formFactory,
        private readonly MediaCrud               $mediaCrud,
        private readonly WebsiteConfigRepository $websiteConfigRepository,
        private readonly SocialItemRepository    $socialItemRepository,
        private readonly SocialItemCrud          $socialItemCrud
    )
    {
    }

    /**
     * @throws ReflectionException
     * @throws Exception
     */
    #[Route(path: '/', name: 'dashboard', methods: ['GET', 'POST'])]
    public function dashboard(Request $request): Response
    {
        $avatarForm = $this->mediaCrud->mediaSingleUploadForm($request, MediaTypeEnum::AVATAR, 'avatarForm');
        if ($avatarForm === true) {
            $this->addFlash('success', 'Avatar enregistré !');
            return $this->redirectTo('referer', $request);
        }

        $avatarImg = VueDataFormatter::makeVueObjectOf(
            [$this->mediaRepository->findOneBy(['type' => MediaTypeEnum::AVATAR->value])],
            ['id', 'mediaPath']
        )->getOne();

        $showreelThumbnailForm = $this->mediaCrud->mediaSingleUploadForm($request, MediaTypeEnum::SHOWREEL_THUMBNAIL, 'showreelThumbnailForm');
        if ($showreelThumbnailForm === true) {
            $this->addFlash('success', 'Vignette de showreel enregistrée !');
            return $this->redirectTo('referer', $request);
        }

        $showreelImg = VueDataFormatter::makeVueObjectOf(
            [$this->mediaRepository->findOneBy(['type' => MediaTypeEnum::SHOWREEL_THUMBNAIL->value])],
            ['id', 'mediaPath']
        )->getOne();

        $showreelVideo = $this->mediaRepository->findOneBy(['type' => MediaTypeEnum::SHOWREEL_VIDEO->value]) ?? new Media();
        $showreelVideoForm = $this->formFactory->createNamed('showreelVideoForm', ShowreelVideoType::class, $showreelVideo);

        $showreelVideoForm->handleRequest($request);
        if ($showreelVideoForm->isSubmitted() && $showreelVideoForm->isValid()) {
            $showreelVideo
                ->setMediaPath($showreelVideoForm->get('mediaPath')->getData())
                ->setMediaSize(0)
                ->setType(MediaTypeEnum::SHOWREEL_VIDEO);

            $this->entityManager->persist($showreelVideo);
            $this->entityManager->flush();
            $this->addFlash('success', 'Video ajoutée !');
            return $this->redirectTo('referer', $request);
        }

        $showreelVideoId = VueDataFormatter::makeVueObjectOf(
            [$this->mediaRepository->findOneBy(['type' => MediaTypeEnum::SHOWREEL_VIDEO->value])],
            ['mediaPath'])->getOne();

        $meufForm = $this->mediaCrud->mediaSingleUploadForm($request, MediaTypeEnum::MEUF, 'meufForm');
        if ($meufForm === true) {
            $this->addFlash('success', 'Meuf ajoutée ! :)');
            return $this->redirectTo('referer', $request);
        }

        $meufImg = VueDataFormatter::makeVueObjectOf(
            [$this->mediaRepository->findOneBy(['type' => MediaTypeEnum::MEUF->value])],
            ['id', 'mediaPath']
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
            $this->addFlash('success', 'Curseur modifié !');
            return $this->redirectTo('referer', $request);
        } else {
            $cursorFormViews = array_map(fn(FormInterface $form) => $form->createView(), $cursorForms);
        }

        $cursorImgs = VueDataFormatter::makeVueObjectOf(
            $cursors,
            ['id', 'mediaPath']
        )->get();

        $websiteConfigObject = $this->websiteConfigRepository->find(1) ?? new WebsiteConfig();
        $websiteConfigForm = $this->formFactory->createNamed(
            'websiteConfigForm',
            WebsiteConfigType::class,
            $websiteConfigObject,
            ['illustrations' => $this->mediaRepository->findBy(['type' => MediaTypeEnum::ILLUSTRATION->value])]
        );
        $websiteConfigForm->handleRequest($request);
        if ($websiteConfigForm->isSubmitted() && $websiteConfigForm->isValid()) {
            $favicon = $this->mediaRepository->findOneBy(['type' => MediaTypeEnum::FAVICON->value]) ?? new Media();

            if ($this->uploadManager->uploadOne($websiteConfigForm, $favicon, MediaTypeEnum::FAVICON) === true)
                $this->entityManager->persist($favicon);

            $websiteConfigObject = $websiteConfigForm->getData();

            $this->entityManager->persist($websiteConfigObject);
            $this->entityManager->flush();

            $this->addFlash('success', 'Métadata enregistrés !');

            return $this->redirectTo('referer', $request);
        }

        $websiteConfig = VueDataFormatter::makeVueObjectOf(
            [$this->websiteConfigRepository->find(1)],
            ['seoImg', 'title', 'description']
        )->getOne();


        $allIllustrations = $this->mediaRepository->findBy(['type' => MediaTypeEnum::ILLUSTRATION->value]);
        $randomIllustration = !empty($allIllustrations) ? $allIllustrations[rand(0, count($allIllustrations) - 1)] : null;
        $seoObject = new Seo(
            title: $websiteConfig['title'] ?? SeoDefaultsEnum::TITLE->value,
            description: $websiteConfig['description'] ?? SeoDefaultsEnum::DESCRIPTION->value,
            image: $this->mediaRepository->findOneBy(['mediaPath' => $websiteConfig['seoImg'] ?? 'invalid']) ?? $randomIllustration
        );

        $isDefaultWebsiteConfig = [];
        if ($websiteConfig !== null) {
            foreach ($websiteConfig as $key => $config) {
                $isDefaultWebsiteConfig[$key] = $config === null;
            }
        } else {
            foreach (['seoImg', 'title', 'description'] as $config) {
                $isDefaultWebsiteConfig[$config] = true;
            }
        }

        $seo = VueDataFormatter::makeVueObjectOf([$seoObject])->getOne();

        $favicon = VueDataFormatter::makeVueObjectOf(
            [$this->mediaRepository->findOneBy(['type' => MediaTypeEnum::FAVICON->value])],
            ['id', 'mediaPath']
        )->getOne();

        $socialItemObjects = $this->socialItemRepository->findAll();
        $socialItems = VueDataFormatter::makeVueObjectOf($socialItemObjects)->get();
        $newSocialItem = new SocialItem();
        $newSocialItemForm = $this->formFactory->createNamed('newSocialItemForm', SocialItemType::class, $newSocialItem);

        $newSocialItemForm->handleRequest($request);
        if ($newSocialItemForm->isSubmitted() && $newSocialItemForm->isValid()) {
            $newSocialItem = $newSocialItemForm->getData();
            $this->entityManager->persist($newSocialItem);
            $this->entityManager->flush();
            $this->addFlash('success', 'Lien réseau social enregistré !');
            return $this->redirectTo('referer', $request);
        }

        $socialItemForms = [];
        foreach ($socialItemObjects as $socialItem) {
            $socialItemForms[$socialItem->getId()] = $this->formFactory->createNamed('socialItemForm-' . $socialItem->getId(), SocialItemType::class, $socialItem);
            $socialItemForms[$socialItem->getId()]->handleRequest($request);
            if ($socialItemForms[$socialItem->getId()]->isSubmitted() && $socialItemForms[$socialItem->getId()]->isValid()) {
                $socialItem = $socialItemForms[$socialItem->getId()]->getData();
                $this->entityManager->persist($socialItem);
                $this->entityManager->flush();
                $this->addFlash('success', 'Lien réseau social enregistré !');
                return $this->redirectTo('referer', $request);
            }
            $socialItemForms[$socialItem->getId()] = $socialItemForms[$socialItem->getId()]->createView();
        }

        return $this->render('admin/dashboard.html.twig', [
            'avatarForm' => $avatarForm,
            'avatarImg' => $avatarImg,
            'showreelThumbnailForm' => $showreelThumbnailForm,
            'showreelImg' => $showreelImg,
            'meufForm' => $meufForm,
            'meufImg' => $meufImg,
            'cursorImgs' => $cursorImgs,
            'cursorForms' => $cursorFormViews,
            'showreelVideo' => $showreelVideo,
            'showreelVideoForm' => $showreelVideoForm,
            'showreelVideoId' => $showreelVideoId,
            'websiteConfig' => $seo,
            'websiteConfigForm' => $websiteConfigForm,
            'favicon' => $favicon,
            'isDefaultWebsiteConfig' => $isDefaultWebsiteConfig,
            'socialItems' => $socialItems,
            'socialItemForms' => $socialItemForms,
            'newSocialItemForm' => $newSocialItemForm
        ]);
    }

    /**
     * @throws Exception
     */
    #[Route(path: '/CVItem/intervention', name: 'CVItem_intervention', methods: ['GET', 'POST'])]
    public function interventions(Request $request): Response
    {
        $itemsAndForms = $this->CVItemCrud->getCVItemsFormViewAndObjects($request, CVItemTypeEnum::INTERVENTION);
        if ($itemsAndForms === true) {
            $this->addFlash('success', 'Intervention enregistrée !');
            return $this->redirectTo('referer', $request);
        }

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
        if ($itemsAndForms === true) {
            $this->addFlash('success', 'Skill enregistré !');
            return $this->redirectTo('referer', $request);
        }

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
        if ($itemsAndForms === true) {
            $this->addFlash('success', 'Experience enregistrée !');
            return $this->redirectTo('referer', $request);
        }

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
        if ($request->isMethod('POST')) {
            dd($request->get('media')->getData());
        }

        $motionForm = $this->mediaCrud->mediaUploadForm($request, MediaTypeEnum::MOTION);

        if ($motionForm === true) {
            $this->addFlash('success', 'Gif ajouté !');
            return $this->redirectTo('referer', $request);
        }

        $motionGifs = VueDataFormatter::makeVueObjectOf($this->mediaRepository->findBy(['type' => MediaTypeEnum::MOTION->value]),
            ['id', 'mediaPath']
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
        if ($illustrationForm === true) {
            $this->addFlash('success', 'Illustration ajouté !');
            return $this->redirectTo('referer', $request);
        }

        $illustrationImgs = VueDataFormatter::makeVueObjectOf($this->mediaRepository->findBy(['type' => MediaTypeEnum::ILLUSTRATION->value]),
            ['id', 'mediaPath']
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
        if ($contactForm === true) {
            $this->addFlash('success', 'Image ajouté !');
            return $this->redirectTo('referer', $request);
        }

        $contactImgs = VueDataFormatter::makeVueObjectOf($this->mediaRepository->findBy(['type' => MediaTypeEnum::CONTACT->value]),
            ['id', 'mediaPath']
        )->get();

        return $this->render('admin/contact.html.twig', [
            'contactForm' => $contactForm->createView(),
            'contactImgs' => $contactImgs
        ]);
    }
}