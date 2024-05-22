<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Navigation extends AbstractController
{
    public function getPublicNavigation(): array
    {
        return [
            'home' => [
                'label' => 'home',
                'link' => $this->generateUrl('app_home')
            ],
            'about' => [
                'label' => 'about',
                'link' => $this->generateUrl('app_about')
            ],
            'motion' => [
                'label' => 'motion',
                'link' => $this->generateUrl('app_motion')
            ],
            'illustration' => [
                'label' => 'illustration',
                'link' => $this->generateUrl('app_illustration')
            ],
            'admin' => [
                'label' => 'admin',
                'link' => $this->generateUrl('app_admin_dashboard')
            ]
        ];
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
            'motion' => [
                'label' => 'motion',
                'link' => $this->generateUrl('app_admin_motion')
            ]
        ];
    }
}