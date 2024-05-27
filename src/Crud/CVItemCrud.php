<?php

namespace App\Crud;

use App\Crud\Manager\AbstractCrud;
use App\Crud\Manager\AfterCrudTrait;
use App\Crud\Manager\CrudSetting;
use App\Crud\Manager\DeleteManager;
use App\Crud\Manager\SaveManager;
use App\Crud\Manager\UploadManager;
use App\Entity\CVItem;
use App\Form\CVItemType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[CrudSetting(entity: CVItem::class, formType: CVItemType::class)]
class CVItemCrud extends AbstractCrud
{
    use AfterCrudTrait;

    public function __construct(
        SaveManager $saveManager,
        DeleteManager $deleteManager,
        UploadManager $uploadManager,
        private readonly EntityManagerInterface $entityManager
    )
    {
        parent::__construct($saveManager, $deleteManager, $uploadManager);
    }

    #[Route(path: '/admin/CVItem/{id}/delete', name: 'app_admin_CVItem_delete', methods: ['GET'])]
    public function delete(CVItem $CVItem, Request $request): RedirectResponse
    {
        $this->entityManager->remove($CVItem);
        $this->entityManager->flush();

        $this->redirectTo('referer', $request);
    }
}