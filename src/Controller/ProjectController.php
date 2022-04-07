<?php

namespace App\Controller;

use App\Entity\Fact;
use App\Entity\Projet;
use App\Repository\FactRepository;
use App\Repository\MilestoneRepository;
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
    public function index(ProjetRepository $projetRepository, StatusRepository $statusRepository, MilestoneRepository $milestoneRepository, FactRepository $factRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $queryProjects = $projetRepository->getProjet();
        $queryFacts = $factRepository->getFact();
        $queryMilestones = $milestoneRepository->getMilestone();

        $projects = $paginator->paginate(
            $queryProjects,
            $request->query->get('page', 1),
            8
        );
        $facts = $paginator->paginate(
            $queryFacts,
            $request->query->get('page', 1),
            9
        );
        $milestones = $paginator->paginate(
            $queryMilestones,
            $request->query->get('page', 1),
            8
        );
        return $this->render('project/dashboard.html.twig', [
            'projects' => $projects,
            'status' => $statusRepository->findAll(),
            'milestones' => $milestones,
            'facts' => $facts
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
    #[Route('/fact/{id}', name: 'app_show_fact')]
    public function showFact(Fact $fact): Response
    {
        return $this->render('project/show.html.twig', [
            'fact' => $fact,

        ]);
    }
}
