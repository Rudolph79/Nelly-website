<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Repository\OrderRepository;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\OrderDetails;
use Doctrine\ORM\EntityManagerInterface;

class PaymentController extends AbstractController
{
    /**
     * @Route("/commande/paiement/{id_order}", name="app_payment")
     */
    public function index($id_order, OrderRepository $orderRepository, EntityManagerInterface $em): Response
    {
        Stripe::setApiKey($_ENV['STRIPE_SECRET_KEY']);
        $YOUR_DOMAIN = $_ENV['DOMAIN'];

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
            'success_url' => $YOUR_DOMAIN . '/commande/merci/{CHECKOUT_SESSION_ID}',
            'cancel_url' => $YOUR_DOMAIN . '/mon-panier/annulation',
        ]);

        header("HTTP/1.1 303 See Other");
        header("Location: " . $checkout_session->url);

        $order->setStripeSessionId($checkout_session->id);
        $em->flush();

        return $this->redirect($checkout_session->url);
    }

    /**
     * @Route("/commande/merci/{stripe_session_id}", name="app_payment_success")
     */
    public function success($stripe_session_id, OrderRepository $orderRepository, 
        EntityManagerInterface $em, Cart $cart): Response
    {
        $order = $orderRepository->findOneBy([
            'stripe_session_id' => $stripe_session_id,
            'user' => $this->getUser()
        ]);

        if (!$order) {
            return $this->redirectToRoute('app_home');
        }

        if ($order->isIsPaid() !== 1) {
            $order->setIsPaid(1);
            $cart->remove();
            $em->flush();
        }
        // dd($order);

        return $this->render('payment/success.html.twig');
    }
}
