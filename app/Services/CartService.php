<?php

namespace App\Services;

use App\Repositories\CartRepository;

class CartService
{
    protected $cartRepository;

    public function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    public function addToCart($userId, $productId)
    {
        return $this->cartRepository->addProductToCart($userId, $productId);
    }

    public function removeFromCart($userId, $cartItemId)
    {
        return $this->cartRepository->removeProductFromCart($userId, $cartItemId);
    }

    public function clearCart($userId)
    {
        return $this->cartRepository->clearUserCart($userId);
    }
}
