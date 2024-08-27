<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponseHelper;
use Illuminate\Http\Request;
use App\Services\CartService;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ResponseHelper;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    // Add a product to the cart
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
        ]);

        if ($validator->fails()) {
            return ApiResponseHelper::formError('Form validation error', $validator->errors(), 400);
        }

        DB::beginTransaction();

        try {
            $validatedData = $validator->validated();
            $user = Auth::user();
            $productId = $validatedData['product_id'];

            $result = $this->cartService->addToCart($user->id, $productId);

            if ($result) {
                DB::commit();
                return ApiResponseHelper::success('Produk berhasil ditambahkan ke keranjang.');
            }

            DB::rollBack();
            return ApiResponseHelper::error('Gagal menambahkan produk ke keranjang.');

        } catch (Exception $e) {
            DB::rollBack();
            return ApiResponseHelper::error('Error :' . $e->getMessage(), 500);
        }
    }

    // Remove a product from the cart
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $user = Auth::user();

            $result = $this->cartService->removeFromCart($user->id, $id);

            if ($result) {
                DB::commit();
                return ApiResponseHelper::success('Produk berhasil dihapus dari keranjang.');
            }

            DB::rollBack();
            return ApiResponseHelper::error('Gagal menghapus produk dari keranjang.');

        } catch (Exception $e) {
            DB::rollBack();
            return ApiResponseHelper::error('Error: ' . $e->getMessage(), 500);
        }
    }

    // Clear the entire cart
    public function clear()
    {
        DB::beginTransaction();

        try {
            $user = Auth::user();

            $result = $this->cartService->clearCart($user->id);

            if ($result) {
                DB::commit();
                return ApiResponseHelper::success('Berhasil menghapus seluruh produk dari keranjang.');
            }

            DB::rollBack();
            return ApiResponseHelper::error('Gagal menghapus seluruh produk dari keranjang.');

        } catch (Exception $e) {
            DB::rollBack();
            return ApiResponseHelper::error('Error: ' . $e->getMessage(), 500);
        }
    }
}
