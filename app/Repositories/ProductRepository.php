<?php

namespace App\Repositories;

use App\Models\Product;
use App\Contracts\BaseRepository;


class ProductRepository implements BaseRepository
{
    /**
     * Create a new class instance.
     */
    protected $model;
    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    public function query()
    {
        return $this->model->newQuery();
    }
    

    public function find($id)
    {
        return $this->model->find($id);

    }
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $product = $this->model->find($id);
        if ($product) {
            $product->update($data);
            return $product;
        }
        return null;
    }
    
    public function delete($product)
    {
        return $product->delete();
    }

    public function findCheapest($product)
    {
        return $product->pharmacies()
            ->select('pharmacies.id', 'pharmacies.name')
            ->withPivot('price')
            ->orderBy('pharmacy_product.price', 'asc')
            ->limit(5)
            ->get()
            ->map(function ($pharmacy) {
                return [
                    'Pharmacy id'    => $pharmacy->id,
                    'Pharmacy name'  => $pharmacy->name,
                    'price' => (float) $pharmacy->pivot->price,
                ];
            })
            ->toArray();
    }
}
