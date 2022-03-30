<?php

namespace App\Controller;

use App\Repository\EntrepriseRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(EntrepriseRepository $entrepriseRepository, UserRepository $userRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'entreprises' => $entrepriseRepository->findAll(),
            'users' => $userRepository->findAll(),
            'clients' => $userRepository->findByRole('ROLE_CLIENT')
        ]);
    }
}