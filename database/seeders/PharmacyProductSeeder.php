<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Pharmacy;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PharmacyProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pharmacyIds = Pharmacy::pluck('id')->toArray();
        Product::chunk(500, function ($products) use ($pharmacyIds) {
            foreach ($products as $product) {
                $randomPharmacies = collect($pharmacyIds)
                    ->random(rand(3, 10))
                    ->mapWithKeys(fn ($id) => [
                        $id => ['price' => fake()->randomFloat(2, 20, 10000)]
                    ])
                    ->toArray();
                $product->pharmacies()->attach($randomPharmacies);
            }
        });
    }
}
