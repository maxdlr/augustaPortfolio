<?php

namespace App\Controller;

use App\Entity\CVItem;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class CVItemController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
    )
    {
    }

    /**
     * @throws Exception
     */
    #[Route(path: '/cv-item/{id}/delete', name: 'app_admin_cv-item_delete', methods: ['GET'])]
    public function index(CVItem $cvItem): JsonResponse
    {
        $CVItemTitle = $cvItem->getTitle();

        $this->entityManager->remove($cvItem);
        $this->entityManager->flush();

        return new JsonResponse(['message' => $CVItemTitle . ' est bien supprimé !']);
    }
}