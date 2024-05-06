<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ManagementController extends AbstractController
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    
    /**
     * @Route("/gestion", name="app_management")
     */
    public function index(): Response
    {
        $products = $this->productRepository->findAll();
        $products_extreme_nord = $this->productRepository->findByRegion('Extrême Nord');
        $products_nord = $this->productRepository->findByRegion('Nord');
        $products_adamaoua = $this->productRepository->findByRegion('Adamaoua');
        $products_center = $this->productRepository->findByRegion('Centre');
        $products_nord_ouest = $this->productRepository->findByRegion('Nord-Ouest');
        $products_ouest = $this->productRepository->findByRegion('Ouest');
        $products_sud_ouest = $this->productRepository->findByRegion('Sud-Ouest');
        $products_littoral = $this->productRepository->findByRegion('Littoral');
        $products_sud = $this->productRepository->findByRegion('Sud');
        $products_est = $this->productRepository->findByRegion('Est');


        $nb_products = count($products);
        $nb_products_extreme_nord = count($products_extreme_nord);
        $nb_products_nord = count($products_nord);
        $nb_products_adamaoua = count($products_adamaoua);
        $nb_products_center = count($products_center);
        $nb_products_nord_ouest = count($products_nord_ouest);
        $nb_products_ouest = count($products_ouest);
        $nb_products_sud_ouest = count($products_sud_ouest);
        $nb_products_littoral = count($products_littoral);
        $nb_products_sud = count($products_sud);
        $nb_products_est = count($products_est);

        // dd($nb_products_adamaoua);
        return $this->render('management/index.html.twig', [
            'nb_products' => $nb_products,
            'nb_products_extreme_nord' => $nb_products_extreme_nord,
            'nb_products_nord' => $nb_products_nord,
            'nb_products_adamaoua' => $nb_products_adamaoua,
            'nb_products_center' => $nb_products_center,
            'nb_products_nord_ouest' => $nb_products_nord_ouest,
            'nb_products_ouest' => $nb_products_ouest,
            'nb_products_sud_ouest' => $nb_products_sud_ouest,
            'nb_products_littoral' => $nb_products_littoral,
            'nb_products_sud' => $nb_products_sud,
            'nb_products_est' => $nb_products_est
        ]);
    }
}
