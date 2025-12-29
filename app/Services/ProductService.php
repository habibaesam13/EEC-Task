<?php

namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService
{

    protected $repository;
    /**
     * Create
     *  a new class instance.
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->repository=$productRepository;
    }
    public function getCheapestPharmacies(int $productId): array
    {
        $product = $this->repository->find($productId);
        if (!$product) {
            return []; 
        }
        // Get pharmacies ordered by pivot price
        $cheapest = $this->repository->findCheapest($product);

        return $cheapest;
    }
}
