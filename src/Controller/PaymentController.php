<?php

namespace App\Controller;

use App\Repository\OrderRepository;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\OrderDetails;

class PaymentController extends AbstractController
{
    /**
     * @Route("/commande/paiement/{id_order}", name="app_payment")
     */
    public function index($id_order, OrderRepository $orderRepository): Response
    {
        Stripe::setApiKey('sk_test_51KYix6EKBdY2vFl9JSDiHBU3rrqRrMVYKS9yJPo1xz4Wf7oZfVhyuUJXefBhpdJlQ33cZbPnNK5UDk9rEtKQ4i2I00OcScD5EK');
        $YOUR_DOMAIN = 'https://localhost:8000';

        // $order = $orderRepository->findOneById($id_order);
        $order = $orderRepository->findOneBy([
            'id' => $id_order,
            'user' => $this->getUser()
        ]);

        if (!$order) {
            return $this->redirectToRoute('app_home');
        }

        $products_for_stripe = [];

        /** @var \App\Entity\OrderDetails $product */
        foreach ($order->getOrderDetails() as $product) {
            // dump($product);
            $products_for_stripe[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'unit_amount' => number_format($product->getPriceEuro(), 0, '', ''),
                    'product_data' => [
                        'name' => $product->getProduct(),
                        'images' => [
                            $YOUR_DOMAIN . '/uploads/' . $product->getIllustration()
                        ]
                    ]
                ],
                'quantity' => $product->getQuantity(),
            ];
        }

        $checkout_session = Session::create([
            'line_items' => [[
                $products_for_stripe
            ]],
            'mode' => 'payment',
            'success_url' => $YOUR_DOMAIN . '/success.html',
            'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
        ]);

        header("HTTP/1.1 303 See Other");
        header("Location: " . $checkout_session->url);

        return $this->redirect($checkout_session->url);
    }
}
