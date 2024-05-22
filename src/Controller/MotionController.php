<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MotionController extends AbstractController
{
    #[Route(path: '/motion', name: 'app_motion', methods: ['POST', 'GET'])]
    public function index(): Response
    {
        return $this->render('pages/motion.html.twig');
    }
}