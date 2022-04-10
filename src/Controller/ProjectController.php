<?php

namespace App\Controller;

use App\Entity\Fact;
use App\Entity\Milestone;
use App\Entity\Projet;
use App\Entity\Risk;
use App\Form\FactFormType;
use App\Form\MilestoneFormType;
use App\Form\ProjectFormType;
use App\Form\RiskFormType;
use App\Repository\AdminRepository;
use App\Repository\BudgetRepository;
use App\Repository\FactRepository;
use App\Repository\MilestoneRepository;
use App\Repository\ProjetRepository;
use App\Repository\RiskRepository;
use App\Repository\StatusRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function index(StatusRepository $statusRepository, MilestoneRepository $milestoneRepository, FactRepository $factRepository, PaginatorInterface $paginator, Request $request, AdminRepository $adminRepository): Response
    {
        $user = $this->getUser();
        $username  = $user->getUserIdentifier();
        $team = $adminRepository->findOneBy(['username' => $username])->getTeam();

        if ($team !== null) {
            $queryProjects = $team->getProjet();
            $projects = $paginator->paginate(
                $queryProjects,
                $request->query->get('page', 1),
                8
            );
        }

        //$queryProjects = $projetRepository->getProjet();
        $queryFacts = $factRepository->getFact();
        $queryMilestones = $milestoneRepository->getMilestone();


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
        ]);
    }

    #[Route('/projects', name: 'app_projects')]
    public function projects(AdminRepository $adminRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $user = $this->getUser();
        $username  = $user->getUserIdentifier();
        $team = $adminRepository->findOneBy(['username' => $username])->getTeam();

        if ($team !== null) {
            $queryProjects = $team->getProjet();
            $projects = $paginator->paginate(
                $queryProjects,
                $request->query->get('page', 1),
                15
            );
        }

        return $this->render('project/projects.html.twig', [
            'projects' => $projects
        ]);
    }

    #[Route('/new', name: 'app_create_project', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response {
        $project = new Projet();
        $form = $this->createForm(ProjectFormType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($project);
            $entityManager->flush();

            return $this->redirectToRoute('app_homepage', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('project/new.html.twig', [
            'project' => $project,
            'form' => $form,
        ]);
    }

    #[Route('/project/{id}', name: 'app_show_project')]
    public function show(Projet $project, RiskRepository $riskRepository, $id, BudgetRepository $budgetRepository, MilestoneRepository $milestoneRepository): Response
    {
        return $this->render('project/show.html.twig', [
            'project' => $project,
            'risks' => $riskRepository->findByProjectId($id),
            'budgets' => $budgetRepository->findAll(),
            'milestones' => $milestoneRepository->findByProjectId($id)

        ]);
    }

    #[Route('/project/{id}/edit', name: 'app_edit_project', methods: ['GET', 'POST'])]
    public function edit(Request $request, Projet $project, EntityManagerInterface $entityManager): Response {
        $form = $this->createForm(ProjectFormType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_homepage', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('project/edit.html.twig', [
            'project' => $project,
            'form' => $form,
        ]);
    }

    #[Route('/fact/{id}', name: 'app_show_fact')]
    public function showFact(Projet $project, RiskRepository $riskRepository, $id, BudgetRepository $budgetRepository, MilestoneRepository $milestoneRepository): Response
    {
        return $this->render('project/show.html.twig', [
            'project' => $project,
            'risks' => $riskRepository->findByProjectId($id),
            'budgets' => $budgetRepository->findAll(),
            'milestones' => $milestoneRepository->findAll()

        ]);
    }
    #[Route('/fact/{id}/edit', name: 'app_edit_fact', methods: ['GET', 'POST'])]
    public function editFact(Request $request, Fact $fact, EntityManagerInterface $entityManager): Response {
        $form = $this->createForm(FactFormType::class, $fact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_homepage', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('project/fact/edit.html.twig', [
            'fact' => $fact,
            'form' => $form,
        ]);
    }
    #[Route('/newFact', name: 'app_create_fact', methods: ['GET', 'POST'])]
    public function newFact(Request $request, EntityManagerInterface $entityManager): Response {
        $risk = new Fact();
        $form = $this->createForm(FactFormType::class, $risk);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($risk);
            $entityManager->flush();

            return $this->redirectToRoute('app_homepage', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('project/risk/new.html.twig', [
            'risk' => $risk,
            'form' => $form,
        ]);
    }

    #[Route('/risk/{id}', name: 'app_show_risk')]
    public function showRisk(Projet $project, RiskRepository $riskRepository, $id, BudgetRepository $budgetRepository, MilestoneRepository $milestoneRepository): Response
    {
        return $this->render('project/risk/show.html.twig', [
            'project' => $project,
            'risks' => $riskRepository->findByProjectId($id),
            'budgets' => $budgetRepository->findAll(),
            'milestones' => $milestoneRepository->findAll()

        ]);
    }
    #[Route('/risk/{id}/edit', name: 'app_edit_risk', methods: ['GET', 'POST'])]
    public function editRisk(Request $request, Risk $risk, EntityManagerInterface $entityManager): Response {
        $form = $this->createForm(RiskFormType::class, $risk);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_homepage', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('project/risk/edit.html.twig', [
            'risk' => $risk,
            'form' => $form,
        ]);
    }
    #[Route('/newRisk', name: 'app_create_risk', methods: ['GET', 'POST'])]
    public function newRisk(Request $request, EntityManagerInterface $entityManager): Response {
        $risk = new Risk();
        $form = $this->createForm(RiskFormType::class, $risk);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($risk);
            $entityManager->flush();

            return $this->redirectToRoute('app_homepage', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('project/risk/new.html.twig', [
            'risk' => $risk,
            'form' => $form,
        ]);
    }
    #[Route('/newMilestone', name: 'app_create_milestone', methods: ['GET', 'POST'])]
    public function newMilestone(Request $request, EntityManagerInterface $entityManager): Response {
        $milestone = new Milestone();
        $form = $this->createForm(MilestoneFormType::class, $milestone);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($milestone);
            $entityManager->flush();

            return $this->redirectToRoute('app_homepage', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('milestone/new.html.twig', [
            'milestone' => $milestone,
            'form' => $form,
        ]);
    }
}
