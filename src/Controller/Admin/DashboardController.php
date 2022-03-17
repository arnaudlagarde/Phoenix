<?php

namespace App\Controller\Admin;

use App\Entity\Budget;
use App\Entity\CrucialFact;
use App\Entity\Fact;
use App\Entity\Portfolio;
use App\Entity\Projet;
use App\Entity\Risk;
use App\Entity\Status;
use App\Entity\Milestone;
use App\Entity\Team;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $routeBuilder = $this->container->get(AdminUrlGenerator::class);
        $url = $routeBuilder->setController(ProjetCrudController::class)->generateUrl();

        return $this->redirect($url);

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Phoenix');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Project', 'fas fa-map-marker-alt', Projet::class);
        yield MenuItem::linkToCrud('Status', 'fas fa-comments', Status::class);
        yield MenuItem::linkToCrud('User', 'fas fa-users', User::class);
        yield MenuItem::linkToCrud('Team', 'fas fa-users', Team::class);
        yield MenuItem::linkToCrud('Milestone', 'fas fa-milestone', Milestone::class);
        yield MenuItem::linkToCrud('Risk', 'fa fa-meh-o', Risk::class);
        yield MenuItem::linkToCrud('Portfolio', 'fas fa-portrait', Portfolio::class);
        yield MenuItem::linkToCrud('Fact', 'fas fa-check-circle', Fact::class);
        yield MenuItem::linkToCrud('CrucialFact', 'fas fa-check-square', CrucialFact::class);
        yield MenuItem::linkToCrud('Budget', 'fa fa-credit-card', Budget::class);

        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
