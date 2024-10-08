<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @Route("/mon-panier/{motif}", name="app_cart", defaults={"motif": null})
     */
    public function index(Cart $cart, $motif): Response
    {
        if ($motif == 'annulation') {
            $this->addFlash('info', 'Paiement annulé, vous pouvez mettre à jour votre panier');
        }
        // return $this->render('cart/index.html.twig', [
        //     'cart' => $cart->getFull()
        // ]);
        $cartItems = $cart->getFull();

        // Calculer le total
        $total = array_sum(array_map(function($item) {
            return $item['product']->getPrice() * $item['quantity'];
        }, $cartItems));

        return $this->render('cart/index.html.twig', [
            'cart' => $cartItems,
            'total' => $total,
            'motif' => $motif
        ]);
    }

    /**
     * @Route("/cart/add/{id}", name="add_to_cart")
     */
    public function add(Cart $cart, $id)
    {
        $cart->add($id);

        return $this->redirectToRoute('app_cart');
    }

    /**
     * @Route("/cart/remove", name="remove_my_cart")
     */
    public function remove(Cart $cart)
    {
        $cart->remove();

        return $this->redirectToRoute('app_products');
    }

    /**
     * @Route("/cart/delete/{id}", name="delete_to_cart")
     */
    public function delete(Cart $cart, $id)
    {
        $cart->delete($id);

        return $this->redirectToRoute('app_cart');
    }

    /**
     * @Route("/cart/decrease/{id}", name="decrease_to_cart")
     */
    public function decrease(Cart $cart, $id)
    {
        $cart->decrease($id);

        return $this->redirectToRoute('app_cart');
    }

    /**
     * @Route("/cart/increase/{id}", name="increase_to_cart")
     */
    public function increase(Cart $cart, $id)
    {
        $cart->increase($id);

        return $this->redirectToRoute('app_cart');
    }
}
