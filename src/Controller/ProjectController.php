<?php

namespace App\Controller;

use App\Entity\Projet;
use App\Repository\ProjetRepository;
use App\Repository\StatusRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function index(ProjetRepository $projetRepository, StatusRepository $statusRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $query = $projetRepository->getProjet();

        $projects = $paginator->paginate(
            $query,
            $request->query->get('page', 1),
            8
        );
        return $this->render('project/dashboard.html.twig', [
            'projects' => $projects,
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
    public function projects(ProjetRepository $projetRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $query = $projetRepository->getProjet();

        $projects = $paginator->paginate(
            $query,
            $request->query->get('page', 1),
            15
        );
        return $this->render('project/projects.html.twig', [
            'projects' => $projects
        ]);
    }
}
