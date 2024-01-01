<?php

namespace App\Controller;

use App\Entity\Category\Search;
use App\Entity\Product;
use App\Form\SearchType;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    private $entityManager;

    private $productRepository;

    private $categoryRepository;

    public function __construct(EntityManagerInterface $entityManager, ProductRepository $productRepository, 
        CategoryRepository $categoryRepository)
    {
        $this->entityManager = $entityManager;
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }
    
    /**
     * @Route("/produits", name="app_products")
     */
    public function index(Request $request): Response
    {
        $products = $this->productRepository->findAll();
        // $categories = $this->categoryRepository->findAll();

        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $search = $form->getData();
            $products = $this->entityManager->getRepository(Product::class)->findWithSearch($search);
        }

        return $this->render('product/products.html.twig', [
            'products' => $products,
            // 'categories' => $categories,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/produit/{slug}", name="product")
     */
    public function show($slug)
    {
        $product = $this->productRepository->findOneBySlug($slug);

        if (!$product) {
            return $this->redirectToRoute('app_products');
        }

        return $this->render('product/show.html.twig', [
            'product' => $product
        ]);
    }
}
