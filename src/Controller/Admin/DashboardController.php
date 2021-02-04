<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Client;
use App\Entity\Experience;
use App\Entity\Gallery;
use App\Entity\Message;
use App\Entity\Project;
use App\Entity\Skill;
use App\Entity\User;
use App\Entity\UserInfo;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->render('bundles/easyAdmin/welcome.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Portfolio');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoRoute('home', 'fa fa-home', 'index');
        yield MenuItem::linktoDashboard('Dashboard', 'fas fa-tools');
        yield MenuItem::linkToCrud('User', 'fas fa-list', User::class);
        yield MenuItem::linkToCrud('UserInfo', 'fas fa-list', UserInfo::class);
        yield MenuItem::linkToCrud('Experience', 'fas fa-list', Experience::class);
        yield MenuItem::linkToCrud('Skill', 'fas fa-list', Skill::class);
        yield MenuItem::linkToCrud('Project', 'fas fa-list', Project::class);
        yield MenuItem::linkToCrud('Category', 'fas fa-list', Category::class);
        yield MenuItem::linkToCrud('Client', 'fas fa-list', Client::class);
        yield MenuItem::linkToCrud('Gallery', 'fas fa-list', Gallery::class);
        yield MenuItem::linkToCrud('Message', 'fas fa-list', Message::class);
    }
}
