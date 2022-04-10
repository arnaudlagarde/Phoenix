<?php

namespace App\Controller;

use App\Entity\Portfolio;
use App\Repository\AdminRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PortfolioController extends AbstractController
{
    #[Route('/portfolio', name: 'app_portfolio')]
    public function index(AdminRepository $adminRepository): Response
    {
        $team = [];
        $user = $this->getUser();
        if ($user !== null) {
            $username = $user->getUserIdentifier();
            $team = $adminRepository->findOneBy(['username' => $username])->getPortfolios();
        }

        return $this->render('portfolio/index.html.twig', [
            'portfolios' => $team,
        ]);
    }

    #[Route('/portfolio/{id}', name: 'app_show_portfolio')]
    public function show(Portfolio $portfolio, $id): Response
    {
        return $this->render('portfolio/show.html.twig', [
            'portfolio' => $portfolio,
        ]);
    }
}
