<?php

namespace App\Repositories;

use App\Models\Cart;

class CartRepository
{
    public function addProductToCart($userId, $productId)
    {
        return Cart::create([
            'user_id' => $userId,
            'product_id' => $productId,
        ]);
    }

    public function removeProductFromCart($userId, $cartItemId)
    {
        return Cart::where('user_id', $userId)->where('id', $cartItemId)->delete();
    }

    public function clearUserCart($userId)
    {
        return Cart::where('user_id', $userId)->delete();
    }
}
