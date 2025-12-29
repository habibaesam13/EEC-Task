<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Storage;

class ProductService
{

    protected $repository;
    /**
     * Create
     *  a new class instance.
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->repository = $productRepository;
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
    public function all(int $pageSize = 10)
    {
        return $this->repository
            ->query()
            ->cursorPaginate($pageSize);
    }

    public function store(array $data)
    {
        // Handle image upload
        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            $data['image'] = $this->storeImage($data['image']);
        }

        return $this->repository->create($data);
    }

    private function storeImage(UploadedFile $image): string
    {
        return $image->store('products', 'public');
    }

    public function destroy(int $productId): void
    {
        $product = $this->repository->find($productId);

        if (! $product) {
            throw new \Exception('Product not found');
        }

        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }
        $this->repository->delete($product);
    }
}
