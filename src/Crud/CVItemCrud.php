<?php

namespace App\Crud;

use App\Crud\Manager\AbstractCrud;
use App\Crud\Manager\AfterCrudTrait;
use App\Crud\Manager\CrudSetting;
use App\Crud\Manager\DeleteManager;
use App\Crud\Manager\SaveManager;
use App\Crud\Manager\UploadManager;
use App\Entity\CVItem;
use App\Entity\Media;
use App\Enum\CVItemTypeEnum;
use App\Form\CVItemType;
use App\Repository\CVItemRepository;
use App\Service\VueDataFormatter;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use ReflectionException;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[CrudSetting(entity: CVItem::class, formType: CVItemType::class)]
class CVItemCrud extends AbstractCrud
{
    use AfterCrudTrait;

    public function __construct(
        SaveManager                             $saveManager,
        DeleteManager                           $deleteManager,
        UploadManager                           $uploadManager,
        private readonly EntityManagerInterface $entityManager,
        private readonly CVItemRepository       $CVItemRepository,
        private readonly FormFactoryInterface   $formFactory
    )
    {
        parent::__construct($saveManager, $deleteManager, $uploadManager);
    }

    /**
     * @throws Exception
     * @throws ReflectionException
     */
    public function getCVItemsFormViewAndObjects(Request $request, CVItemTypeEnum $CVItemTypeEnum): array|true
    {
        $CVItemObjects = $this->CVItemRepository->findBy(['type' => $CVItemTypeEnum->value]);

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
                ->createNamed('form-CVItem-' . $CVItem->getId(), CVItemType::class, $CVItem);
        }

        $CVItemFormViews = array_map(fn(FormInterface $form) => $form->createView(), $CVItemForms);

        foreach ($CVItemForms as $CVItemForm) {
            $CVItemForm->handleRequest($request);
            if ($CVItemForm->isSubmitted() && $CVItemForm->isValid()) {
                $CVItem = $CVItemForm->getData();
                $this->entityManager->persist($CVItem);
                $this->entityManager->flush();
                return true;
            }
        }

        $newCVItem = new CVItem();
        $newCVItemForm = $this->save($request, $newCVItem, [], function ($form, $object) use ($CVItemTypeEnum) {
            assert($object instanceof CVItem, 'This object needs to be a ' . CVItem::class);
            $object->setType($CVItemTypeEnum);
            return true;
        });

        if ($newCVItemForm === true) return true;

        return [
            'CVItemForms' => $CVItemFormViews,
            'newCVItemForm' => $newCVItemForm,
            'CVItems' => $CVItems
        ];
    }

    #[Route(path: '/admin/CVItem/{id}/delete', name: 'app_admin_CVItem_delete', methods: ['GET'])]
    public function delete(CVItem $CVItem, Request $request): RedirectResponse
    {
        $this->entityManager->remove($CVItem);
        $this->entityManager->flush();

        $this->redirectTo('referer', $request);
    }
}