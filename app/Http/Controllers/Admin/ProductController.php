<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use Illuminate\Http\Request;
use App\Helpers\ApiResponseHelper;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 15);
        $products = $this->productService->getAllProducts($perPage);
        return ApiResponseHelper::success('Produk berhasil diambil', $products);
    }

    public function show($id)
    {
        $product = $this->productService->getProductById($id);
        if ($product) {
            return ApiResponseHelper::success('Produk berhasil diambil', $product);
        }
        return ApiResponseHelper::error('Produk tidak ditemukan', [], 404);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image' => 'nullable|string',
            'is_active' => 'required|boolean',
            'is_featured' => 'required|boolean',
        ]);

        try {
            $product = $this->productService->createProduct($request->all());
            return ApiResponseHelper::success('Produk berhasil dibuat', $product, 201);
        } catch (\Exception $e) {
            return ApiResponseHelper::error('Gagal membuat produk', ['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'slug' => 'sometimes|required|string|max:255|unique:products,slug,' . $id,
            'description' => 'nullable|string',
            'price' => 'sometimes|required|numeric',
            'image' => 'nullable|string',
            'is_active' => 'sometimes|required|boolean',
            'is_featured' => 'sometimes|required|boolean',
        ]);

        try {
            $product = $this->productService->updateProduct($id, $request->all());
            if ($product) {
                return ApiResponseHelper::success('Produk berhasil diperbarui', $product);
            }
            return ApiResponseHelper::error('Produk tidak ditemukan', [], 404);
        } catch (\Exception $e) {
            return ApiResponseHelper::error('Gagal memperbarui produk', ['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $result = $this->productService->deleteProduct($id);
            if ($result) {
                return ApiResponseHelper::success('Produk berhasil dihapus');
            }
            return ApiResponseHelper::error('Produk tidak ditemukan', [], 404);
        } catch (\Exception $e) {
            return ApiResponseHelper::error('Gagal menghapus produk', ['error' => $e->getMessage()], 500);
        }
    }
}
