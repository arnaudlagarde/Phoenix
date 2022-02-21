<?php

namespace App\Controller;

use App\Entity\Projet;
use App\Repository\ProjetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function index(ProjetRepository $projetRepository): Response
    {
        return $this->render('project/index.html.twig', [
            'projects' => $projetRepository->findAll(),
        ]);
    }
    #[Route('/projects/{id}', name: 'app_show_project')]
    public function show(ProjetRepository $projetRepository, Projet $projet)
    {
        return $this->render('project/index.html.twig', [

        ]);
    }
}
