<?php

namespace App\Twig;

use App\Classe\Cart;
use Twig\Extension\AbstractExtension;

class CartExtension extends AbstractExtension
{
    private $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    public function getGlobals(): array
    {
        return [
            'total' => $this->cart->getTotal(),
        ];
    }
}
