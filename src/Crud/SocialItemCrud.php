<?php

namespace App\Crud;

use App\Crud\Manager\AbstractCrud;
use App\Crud\Manager\AfterCrudTrait;
use App\Crud\Manager\CrudSetting;
use App\Crud\Manager\DeleteManager;
use App\Crud\Manager\SaveManager;
use App\Crud\Manager\UploadManager;
use App\Entity\SocialItem;
use App\Enum\SocialItemIconEnum;
use App\Form\SocialItemType;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[CrudSetting(entity: SocialItem::class, formType: SocialItemType::class)]
class SocialItemCrud extends AbstractCrud
{
    use AfterCrudTrait;

    public function __construct(
        SaveManager                             $saveManager,
        DeleteManager                           $deleteManager,
        UploadManager                           $uploadManager,
        private readonly EntityManagerInterface $entityManager
    )
    {
        parent::__construct($saveManager, $deleteManager, $uploadManager);
    }

    /**
     * @throws Exception
     */

    #[Route(path: '/admin/SocialItem/{id}/delete', name: 'app_admin_SocialItem_delete', methods: ['GET'])]
    public function delete(SocialItem $SocialItem, Request $request): RedirectResponse
    {
        $this->entityManager->remove($SocialItem);
        $this->entityManager->flush();

        $this->redirectTo('referer', $request);
    }
}