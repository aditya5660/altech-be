<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponseHelper;
use App\Services\ProductService;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required|string|max:255',
            'page' => 'integer|min:1',
            'per_page' => 'integer|min:1|max:100',
        ]);

        $query = $request->input('query');
        $perPage = $request->input('per_page', 10);

        $products = $this->productService->searchProducts($query, $perPage);

        return ApiResponseHelper::success('Produk berhasil ditampilkan', $products);
    }

    public function show($slug)
    {
        $product = $this->productService->getProductBySlug($slug);

        if (!$product) {
            return ApiResponseHelper::error('Produk tidak ditemukan', [], 404);
        }

        return ApiResponseHelper::success('Produk berhasil ditemukan', $product);
    }
}
