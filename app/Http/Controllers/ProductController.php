<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponseHelper;
use App\Services\ProductService;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function search(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'query' => 'nullable|string|max:255',
            'page' => 'integer|min:1',
            'per_page' => 'integer|min:1|max:100',
        ]);
        if ($validator->fails()) {
            return ApiResponseHelper::formError('Form validation error', $validator->errors(), 400);
        }

        $query = $request->input('query');
        $page = $request->input('page', 1);
        $perPage = $request->input('per_page', 10);

        $products = $this->productService->searchProducts($query, $page, $perPage);

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
