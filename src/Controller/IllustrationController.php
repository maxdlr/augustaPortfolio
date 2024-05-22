<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class IllustrationController extends AbstractController
{
    #[Route(path: '/illustration', name: 'app_illustration', methods: ['POST', 'GET'])]
    public function index(): Response
    {
        return $this->render('pages/illustration.html.twig');
    }
}