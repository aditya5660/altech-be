<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function searchProducts($query, $perPage = 10)
    {
        return Product::where('name', 'like', '%' . $query . '%')
            ->orWhere('description', 'like', '%' . $query . '%')
            ->where('is_active', true)
            ->paginate($perPage);
    }

    public function getProductBySlug($slug)
    {
        return Product::where('slug', $slug)
            ->where('is_active', true)
            ->first();
    }


    public function getAll($perPage = 15)
    {
        return Product::paginate($perPage);
    }

    public function getById($id)
    {
        return Product::find($id);
    }

    public function create(array $data)
    {
        return Product::create($data);
    }

    public function update($id, array $data)
    {
        $product = $this->getById($id);
        if ($product) {
            $product->update($data);
            return $product;
        }
        return null;
    }

    public function delete($id)
    {
        $product = $this->getById($id);
        if ($product) {
            return $product->delete();
        }
        return false;
    }
}
