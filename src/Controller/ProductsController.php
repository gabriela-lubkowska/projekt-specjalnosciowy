<?php

namespace App\Controller;

use App\Entity\Kategoria;
use App\Repository\KategoriaRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class ProductsController extends AbstractController
{
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    #[Route('/', name: 'homepage')]
    public function index(KategoriaRepository $kategoriaRepository, ProductRepository $productRepository): Response {
        return new Response($this->twig->render('products/index.html.twig', [
            'kategorie' => $kategoriaRepository->findAll(),
            'produkt' => $productRepository->findAll(),

        ]));
    }

    #[Route('/products/{id}', name: 'kategoria')]
    public function show(Request $request, Kategoria $kategoria, ProductRepository $productRepository, KategoriaRepository $kategoriaRepository): Response
    {
        $offset = max(0, $request->query->getInt('offset', 0));
        $paginator = $productRepository->getProductPaginator($kategoria, $offset);

        return new Response($this->twig->render('products/show.html.twig', [
            'kategorie' => $kategoriaRepository->findAll(),
            'kategoria' => $kategoria,
            'produkt' => $paginator,
            'previous' => $offset - ProductRepository::PAGINATOR_PER_PAGE,
            'next' => min(count($paginator), $offset + ProductRepository::PAGINATOR_PER_PAGE)
        ]));
    }

}
