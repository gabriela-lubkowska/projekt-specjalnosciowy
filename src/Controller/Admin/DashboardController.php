<?php

namespace App\Controller\Admin;

use App\Entity\Kategoria;
use App\Entity\Product;
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
       $url = $routeBuilder->setController(KategoriaCrudController::class)->generateUrl();

        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Projekt Specjalnosciowy');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('Powrót do strony', 'fa fa-home', 'homepage');
        yield MenuItem::linkToCrud('Kategoria', 'fa-solid fa-list', Kategoria::class);
        yield MenuItem::linkToCrud('Produkt', 'fa-solid fa-shirt', Product::class);

    }
}
