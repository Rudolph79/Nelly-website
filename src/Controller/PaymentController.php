<?php

namespace App\Controller;

use Stripe\Checkout\Session;
use Stripe\Stripe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PaymentController extends AbstractController
{
    /**
     * @Route("/commande/paiement", name="app_payment")
     */
    public function index(): Response
    {
        Stripe::setApiKey('sk_test_51KYix6EKBdY2vFl9JSDiHBU3rrqRrMVYKS9yJPo1xz4Wf7oZfVhyuUJXefBhpdJlQ33cZbPnNK5UDk9rEtKQ4i2I00OcScD5EK');

        $checkout_session = Session::create([
            'line_items' => [[
              # Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
              'price' => '{{PRICE_ID}}',
              'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => $YOUR_DOMAIN . '/success.html',
            'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
          ]);
        die('Payment successfully');
    }
}
