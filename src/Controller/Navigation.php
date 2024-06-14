<?php

namespace App\Controller;

use App\Enum\MediaTypeEnum;
use App\Repository\CVItemRepository;
use App\Repository\MediaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Navigation extends AbstractController
{
    public function __construct(
        private readonly MediaRepository  $mediaRepository,
        private readonly CVItemRepository $CVItemRepository
    )
    {
    }

    public function getPublicNavigation(): array
    {
        $navigationItem = [];

        if (!$this->isMediaBaseEmpty(MediaTypeEnum::SHOWREEL_VIDEO) ||
            !$this->isMediaBaseEmpty(MediaTypeEnum::SHOWREEL_THUMBNAIL)) {
            $navigationItem['showreel'] = [
                'label' => 'showreel',
                'link' => '#showreel'
            ];
        }

        if (!$this->isMediaBaseEmpty(MediaTypeEnum::MOTION)) {
            $navigationItem['motion'] = [
                'label' => 'motion',
                'link' => '#motion'
            ];
        }

        if (!$this->isMediaBaseEmpty(MediaTypeEnum::ILLUSTRATION)) {
            $navigationItem['illustration'] = [
                'label' => 'illustration',
                'link' => '#illustration'
            ];
        }

        if (!$this->isCVItemBaseEmpty()) {
            $navigationItem['about'] = [
                'label' => 'about',
                'link' => '#about'
            ];
        }

        $navigationItem['contact'] = [
            'label' => 'contact me',
            'link' => '#contact'
        ];

        if ($this->getUser() !== null) {
            $navigationItem['admin'] = [
                'label' => 'admin',
                'link' => $this->generateUrl('app_admin_dashboard')
            ];
        }

        return $navigationItem;
    }

    private function isMediaBaseEmpty(MediaTypeEnum $mediaType): bool
    {
        return empty($this->mediaRepository->findBy(['type' => $mediaType->value]));
    }

    private function isCVItemBaseEmpty(): bool
    {
        return empty($this->CVItemRepository->findAll());
    }

    public function getAdminNavigation(): array
    {
        return [
            'site' => [
                'label' => 'site',
                'link' => $this->generateUrl('app_home')
            ],
            'dashboard' => [
                'label' => 'dashboard',
                'link' => $this->generateUrl('app_admin_dashboard')
            ],
            'interventions' => [
                'label' => 'interventions',
                'link' => $this->generateUrl('app_admin_CVItem_intervention')
            ],
            'skills' => [
                'label' => 'skills',
                'link' => $this->generateUrl('app_admin_CVItem_skill')
            ],
            'experiences' => [
                'label' => 'experiences',
                'link' => $this->generateUrl('app_admin_CVItem_experience')
            ],
            'motion' => [
                'label' => 'motion',
                'link' => $this->generateUrl('app_admin_motion')
            ],
            'illustration' => [
                'label' => 'illustration',
                'link' => $this->generateUrl('app_admin_illustration')
            ],
            'contact' => [
                'label' => 'contact',
                'link' => $this->generateUrl('app_admin_contact')
            ],
            'logout' => [
                'label' => 'déconnexion',
                'link' => $this->generateUrl('app_logout')
            ]
        ];
    }
}