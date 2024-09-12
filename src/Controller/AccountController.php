<?php

namespace App\Controller;

use App\Repository\OrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    /**
     * @Route("/compte", name="app_account")
     */
    public function index(OrderRepository $orderRepository): Response
    {
        $orders = $orderRepository->findBy([
            'user' => $this->getUser(),
            'isPaid' => 1
        ]);

        // dd($orders);

        return $this->render('account/index.html.twig', [
            'orders' => $orders
        ]);
    }

    /**
     * @Route("/compte/commande/{id_order}", name="app_account_order")
     */
    public function show($id_order, OrderRepository $orderRepository): Response
    {
        $order = $orderRepository->findOneBy([
            'id' => $id_order,
            'user' => $this->getUser()
        ]);

        if (!$order) {
            return $this->redirectToRoute('app_home');
        }

        return $this->render('account/order.html.twig', [
            'order' => $order
        ]);
    }
}
