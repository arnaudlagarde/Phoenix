<?php

namespace App\Controller;

use App\Entity\Projet;
use App\Repository\ProjetRepository;
use App\Repository\StatusRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function index(ProjetRepository $projetRepository, StatusRepository $statusRepository): Response
    {
        return $this->render('project/dashboard.html.twig', [
            'projects' => $projetRepository->findAll(),
            'status' => $statusRepository->findAll()
            //'count' => $projetRepository->projectStatus()
        ]);
    }
    #[Route('/project/{id}', name: 'app_show_project')]
    public function show(Projet $project): Response
    {
        return $this->render('project/show.html.twig', [
            'project' => $project,

        ]);
    }
    #[Route('/projects', name: 'app_projects')]
    public function projects(ProjetRepository $projetRepository): Response
    {
        return $this->render('project/projects.html.twig', [
            'projects' => $projetRepository->findAll(),
        ]);
    }
}
