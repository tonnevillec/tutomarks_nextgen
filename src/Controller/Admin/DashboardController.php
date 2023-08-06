<?php

namespace App\Controller\Admin;

use App\Entity\Authors;
use App\Entity\Categories;
use App\Entity\Events;
use App\Entity\Languages;
use App\Entity\QuoiDeNeufLesDevs;
use App\Entity\SimpleLinks;
use App\Entity\Tags;
use App\Entity\Users;
use App\Entity\YoutubeLinks;
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

        return $this->redirect(
            $routeBuilder->setController(CategoriesCrudController::class)->generateUrl()
        );
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Tutomarks');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::subMenu('Administation')->setSubItems([
            MenuItem::linkToCrud('Categories', 'fas fa-list', Categories::class),
            MenuItem::linkToCrud('Tags', 'fas fa-list', Tags::class),
            MenuItem::linkToCrud('Authors', 'fas fa-list', Authors::class),
            MenuItem::linkToCrud('Languages', 'fas fa-list', Languages::class),
        ]);

        yield MenuItem::subMenu('Utilisateurs')->setSubItems([
            MenuItem::linkToCrud('Users', 'fas fa-list', Users::class),
        ]);

        yield MenuItem::subMenu('Links')->setSubItems([
            MenuItem::linkToCrud('SimpleLinks', 'fas fa-list', SimpleLinks::class),
            MenuItem::linkToCrud('YoutubeLinks', 'fas fa-list', YoutubeLinks::class),
            MenuItem::linkToCrud('Events', 'fas fa-list', Events::class),
        ]);

        yield MenuItem::section();
        yield MenuItem::subMenu('Newletter')->setSubItems([
            MenuItem::linkToCrud('Quoi de Neuf les dev ?', 'fas fa-list', QuoiDeNeufLesDevs::class),
        ]);


        yield MenuItem::section();
        yield MenuItem::linkToUrl('Retour au site', 'far fa-arrow-alt-circle-left', $this->generateUrl('app_home'));
    }
}
