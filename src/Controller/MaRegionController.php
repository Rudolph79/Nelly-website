<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MaRegionController extends AbstractController
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    
    /**
     * @Route("/ma-region/extreme-nord", name="extreme_north")
     */
    public function extreme_nord(): Response
    {
        $products_extreme_nord = $this->productRepository->findByRegion('Extrême Nord');
        $extreme_nord = "Extrême Nord";

        return $this->render('ma_region/extreme_nord.html.twig', [
            'products' => $products_extreme_nord,
            'extreme' => $extreme_nord
        ]);
    }

    /**
     * @Route("/ma-region/nord", name="north")
     */
    public function nord(): Response
    {
        $products_extreme_nord = $this->productRepository->findByRegion('Nord');
        $extreme_nord = "Nord";

        return $this->render('ma_region/nord.html.twig', [
            'products' => $products_extreme_nord,
            'extreme' => $extreme_nord
        ]);
    }

    /**
     * @Route("/ma-region/adamaoua", name="adamaoua")
     */
    public function adamaoua(): Response
    {
        $products_adamaoua = $this->productRepository->findByRegion('Adamaoua');
        $adamaoua = "Adamaoua";

        return $this->render('ma_region/adamaoua.html.twig', [
            'products' => $products_adamaoua,
            'extreme' => $adamaoua
        ]);
    }

    /**
     * @Route("/ma-region/centre", name="center")
     */
    public function centre(): Response
    {
        $products_center = $this->productRepository->findByRegion('Centre');
        $center = "Centre";

        return $this->render('ma_region/centre.html.twig', [
            'products' => $products_center,
            'extreme' => $center
        ]);
    }

    /**
     * @Route("/ma-region/nord-ouest", name="north_west")
     */
    public function nord_ouest(): Response
    {
        $products_nord_ouest = $this->productRepository->findByRegion('Nord-Ouest');
        $nord_ouest = "Nord-Ouest";

        return $this->render('ma_region/nord_ouest.html.twig', [
            'products' => $products_nord_ouest,
            'extreme' => $nord_ouest
        ]);
    }

    /**
     * @Route("/ma-region/nord", name="north")
     */
    public function nord(): Response
    {
        $products_extreme_nord = $this->productRepository->findByRegion('Nord');
        $extreme_nord = "Nord";

        return $this->render('ma_region/nord.html.twig', [
            'products' => $products_extreme_nord,
            'extreme' => $extreme_nord
        ]);
    }

    /**
     * @Route("/ma-region/nord", name="north")
     */
    public function nord(): Response
    {
        $products_extreme_nord = $this->productRepository->findByRegion('Nord');
        $extreme_nord = "Nord";

        return $this->render('ma_region/nord.html.twig', [
            'products' => $products_extreme_nord,
            'extreme' => $extreme_nord
        ]);
    }

    /**
     * @Route("/ma-region/nord", name="north")
     */
    public function nord(): Response
    {
        $products_extreme_nord = $this->productRepository->findByRegion('Nord');
        $extreme_nord = "Nord";

        return $this->render('ma_region/nord.html.twig', [
            'products' => $products_extreme_nord,
            'extreme' => $extreme_nord
        ]);
    }

    /**
     * @Route("/ma-region/nord", name="north")
     */
    public function nord(): Response
    {
        $products_extreme_nord = $this->productRepository->findByRegion('Nord');
        $extreme_nord = "Nord";

        return $this->render('ma_region/nord.html.twig', [
            'products' => $products_extreme_nord,
            'extreme' => $extreme_nord
        ]);
    }

    /**
     * @Route("/ma-region/nord", name="north")
     */
    public function nord(): Response
    {
        $products_extreme_nord = $this->productRepository->findByRegion('Nord');
        $extreme_nord = "Nord";

        return $this->render('ma_region/nord.html.twig', [
            'products' => $products_extreme_nord,
            'extreme' => $extreme_nord
        ]);
    }
}
