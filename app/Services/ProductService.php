<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use Exception;

use Illuminate\Support\Facades\DB;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function searchProducts($query, $page, $perPage = 10)
    {
        return $this->productRepository->searchProducts($query, $page, $perPage);
    }


    public function getProductBySlug($slug)
    {
        return $this->productRepository->getProductBySlug($slug);

    }


    public function getAllProducts($perPage = 15)
    {
        return $this->productRepository->getAll($perPage);
    }

    public function getProductById($id)
    {
        return $this->productRepository->getById($id);
    }

    public function createProduct(array $data)
    {
        DB::beginTransaction();
        try {
            $product = $this->productRepository->create($data);
            DB::commit();
            return $product;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updateProduct($id, array $data)
    {
        DB::beginTransaction();
        try {
            $product = $this->productRepository->update($id, $data);
            DB::commit();
            return $product;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function deleteProduct($id)
    {
        DB::beginTransaction();
        try {
            $result = $this->productRepository->delete($id);
            DB::commit();
            return $result;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
