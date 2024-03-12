<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/join', name: 'app_join_')]
class JoinController extends AbstractController
{
    #[Route('/uno', name: 'uno')]
    public function joinUno(): Response
    {
        return $this->render('join/joinuno.html.twig', [
            'controller_name' => 'JoinController',
        ]);
    }

    #[Route('/dos', name: 'dos')]
    public function JoinDos(): Response
    {
        return $this->render('join/joindos.html.twig', [
            'controller_name' => 'JoinController',
        ]);
    }
}
