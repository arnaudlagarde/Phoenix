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
use App\Repository\BudgetRepository;
use App\Repository\FactRepository;
use App\Repository\MilestoneRepository;
use App\Repository\ProjetRepository;
use App\Repository\RiskRepository;
use App\Repository\StatusRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Psr\Log\LoggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends AbstractController
{

    public function __construct(
        private LoggerInterface $logger,
        private EntityManagerInterface $entityManager
    ) {
    }
    #[Route('/', name: 'app_homepage')]
    public function index(ProjetRepository $projetRepository, StatusRepository $statusRepository, MilestoneRepository $milestoneRepository, FactRepository $factRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $user = $this->getUser();

//        $upcomingProjects = $projetRepository->getUpcomingProjectsByUser($user);
     //   $projectsWithRisks = $projetRepository->getActiveProjectsByUser($user, true);
//        $milestones = $milestoneRepository->getMilestonesByUser($user);


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
            'milestones' => $milestoneRepository->findAll()

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
        $fact = new Fact();
        $form = $this->createForm(FactFormType::class, $fact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($fact);
            $entityManager->flush();

            return $this->redirectToRoute('app_homepage', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('project/fact/new.html.twig', [
            'fact' => $fact,
            'form' => $form,
        ]);
    }












//
//    #[Route('/fact/{id}', name: 'app_show_fact')]
//    public function showFact(Fact $fact): Response
//    {
//        return $this->render('project/show.html.twig', [
//            'fact' => $fact,
//
//        ]);
//    }
//    #[Route('{code}/risk/new', name: 'app_project_risk_new', methods: ['GET', 'POST'])]
//    public function createRisk(Request $request, Projet $project): Response
//    {
//        $risk = (new Risk())
//            ->setProjet($project)
//        ;
//        $form = $this->createForm(RiskFormType::class, $risk);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted()) {
//            if ($form->isValid()) {
//                try {
//                    $this->entityManager->persist($risk);
//                    $this->entityManager->flush();
//
//                    $this->addFlash('success',"Le risque a bien été ajouté");
//
//                    return $this->redirectToRoute('app_project_risk_edit', [
//                        'code' => $project->getCode(),
//                        'risk_id' => $risk->getId(),
//                    ], Response::HTTP_SEE_OTHER);
//                } catch (\Exception $e) {
//                    $this->logger->critical($e->getMessage(), ['exception' => $e, 'risk' => $risk]);
//                    $this->addFlash('error',"Le risque n'a pas été ajouté");
//                }
//            } else {
//                $this->addFlash('danger', "Le risque n'a pas été ajouté");
//            }
//        }
//
//        return $this->renderForm('risk/new.html.twig', [
//            'risk' => $risk,
//            'form' => $form,
//        ]);
//
//    }
//    #[Route('/{code}/risk/{risk_id}/edit', name: 'app_project_risk_edit', methods: ['GET', 'POST'])]
//    #[Entity('risk', expr: 'repository.find(risk_id)')]
//    public function editRisk(Request $request, Projet $project, Risk $risk): Response
//    {
//
//        $form = $this->createForm(RiskFormType::class, $risk);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted()) {
//            if ($form->isValid()) {
//                try {
//                    $this->entityManager->flush();
//
//                    $this->addFlash('success', "Le risque a bien été modifié");
//                } catch (\Exception $e) {
//                    $this->logger->critical($e->getMessage(), ['exception' => $e, 'risk' => $risk]);
//                    $this->addFlash('danger', "Le risque n'a pas pu être modifié");
//                }
//            } else {
//                $this->addFlash('danger', "Le risque n'a pas pu être modifié");
//            }
//        }
//
//        return $this->renderForm('risk/edit.html.twig', [
//            'risk' => $risk,
//            'form' => $form,
//        ]);
//    }
//
//    #[Route('/{code}/milestone/new', name: 'app_project_milestone_new', methods: ['GET', 'POST'])]
//    public function newMilestone(Request $request, Projet $project): Response
//    {
//        $milestone = (new Milestone())
//            ->setProjet($project)
//        ;
//        $form = $this->createForm(MilestoneFormType::class, $milestone);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted()) {
//            if ($form->isValid()) {
//                try {
//                    $this->entityManager->persist($milestone);
//                    $this->entityManager->flush();
//
//                    $this->addFlash('success', "Le jalon a bien été créé");
//
//                    return $this->redirectToRoute('app_project_milestone_edit', [
//                        'code' => $project->getCode(),
//                        'milestone_id' => $milestone->getId(),
//                    ], Response::HTTP_SEE_OTHER);
//                } catch (\Exception $e) {
//                    $this->logger->critical($e->getMessage(), ['exception' => $e, 'milestone' => $milestone]);
//                    $this->addFlash('error', "erreur");
//                }
//            } else {
//                $this->addFlash('danger', "aïe");
//            }
//        }
//
//        return $this->renderForm('milestone/new.html.twig', [
//            'milestone' => $milestone,
//            'form' => $form,
//        ]);
//    }
//    #[Route('/milestone/{milestone_id}/edit', name: 'app_project_milestone_edit', methods: ['GET', 'POST'])]
//    public function editMilestone(Request $request, Projet $project, Milestone $milestone): Response
//    {
//        if ($project !== $milestone->getProjet()) {
//            throw new NotFoundHttpException('Milestone not found.');
//        }
//
//        $form = $this->createForm(MilestoneFormType::class, $milestone);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted()) {
//            if ($form->isValid()) {
//                try {
//                    $this->entityManager->flush();
//
//                    $this->addFlash('success', " Le Jalon a bien été modifié");
//                } catch (\Exception $e) {
//                    $this->logger->critical($e->getMessage(), ['exception' => $e, 'milestone' => $milestone]);
//                    $this->addFlash('danger', "Le jalon n'a pas pu être modifié");
//                }
//            } else {
//                $this->addFlash('danger', "Le jalon n'a pas pu être modifié");
//            }
//        }
//
//        return $this->renderForm('milestone/edit.html.twig', [
//            'milestone' => $milestone,
//            'form' => $form,
//        ]);
//    }
}
