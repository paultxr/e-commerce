<?php

namespace App\Controller\Admin;

use App\Entity\Faq;
use App\Entity\Type;
use App\Entity\User;
use App\Entity\Genre;
use App\Entity\Artist;
use App\Entity\Product;
use Symfony\Component\HttpFoundation\Response;
use App\Controller\Admin\ProductCrudController;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(CrudUrlGenerator::class)->build();
        return $this->redirect($routeBuilder->setController(ProductCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('recordsDealer');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Product', 'fas fa-record-vinyl', Product::class);
        yield MenuItem::linkToCrud('Artist', 'fas fa-user', Artist::class);
        yield MenuItem::linkToCrud('Genre', 'fas fa-music', Genre::class);
        yield MenuItem::linkToCrud('Type', 'fas fa-search', Type::class);
        yield MenuItem::linkToCrud('Faq', 'fas fa-question-circle', Faq::class);
        yield MenuItem::linkToCrud('User', 'far fa-user', User::class);
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
