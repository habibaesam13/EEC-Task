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

    public function update($product,  $data)
    {
        $product->update($data);
        return $product;
    }


    public function delete($product)
    {
        return $product->delete();
    }
    public function search(?string $q)
    {
        //search by title - description -price
        return $this->query()
            ->when($q, function ($query) use ($q) {
                $query->where('title', 'like', "%{$q}%")
                    ->orWhere('description', 'like', "%{$q}%")
                    ->orwhere('price', '<=', (float)$q);
            });
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
    public function getPharmaciesWithPrices(Product $product)
    {
        return $product->pharmacies()
            ->select('pharmacies.id', 'pharmacies.name')
            ->withPivot('price')
            ->orderBy('pharmacy_product.price')
            ->get();
    }
}
