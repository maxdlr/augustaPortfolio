<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Navigation extends AbstractController
{
    public function getPublicNavigation(): array
    {
        return [
            'motion' => [
                'label' => 'motion',
                'link' => '#motion'
            ],
            'illustration' => [
                'label' => 'illustration',
                'link' => '#illustration'
            ],
            'about' => [
                'label' => 'about',
                'link' => '#about'
            ],
            'contact' => [
                'label' => 'contact me',
                'link' => '#contact'
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
            ]
        ];
    }
}