<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AboutController extends AbstractController
{
    #[Route(path: '/about', name: 'app_about', methods: ['POST', 'GET'])]
    public function index(): Response
    {
        return $this->render('pages/about.html.twig');
    }
}