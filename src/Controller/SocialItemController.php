<?php

namespace App\Controller;

use App\Entity\SocialItem;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class SocialItemController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
    )
    {
    }

    /**
     * @throws Exception
     */
    #[Route(path: '/social-item/{id}/delete', name: 'app_admin_cv-item_delete', methods: ['GET'])]
    public function index(SocialItem $socialItem): JsonResponse
    {
        $SocialItem = $socialItem->getIcon();

        $this->entityManager->remove($socialItem);
        $this->entityManager->flush();

        return new JsonResponse(['message' => $SocialItem . ' supprimé !']);
    }
}