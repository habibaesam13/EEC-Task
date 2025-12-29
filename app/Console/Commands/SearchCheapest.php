<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ProductService;

class SearchCheapest extends Command
{
    protected $signature = 'products:search-cheapest {productId}';
    protected $description = 'Get 5 cheapest pharmacies for a product';

    protected $productService;

    public function __construct(ProductService $productService)
    {
        parent::__construct();
        $this->productService = $productService;
    }

    public function handle()
    {
        $productId = $this->argument('productId');

        $cheapest = $this->productService->getCheapestPharmacies($productId);

        if (empty($cheapest)) {
            $this->error("Product not found or no pharmacies available");
            return 1; // failure code
        }

        // Print JSON directly to console
        $this->line(json_encode($cheapest, JSON_PRETTY_PRINT));

        return 0; // success
    }
}
