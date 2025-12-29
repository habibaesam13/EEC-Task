<?php


namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Requests\StoreProduct;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{

    public function __construct(private ProductService $productService)
    {
        $this->productService = $productService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //dd($request->integer('per_page'));
        return response()->json(
            $this->productService->all($request->integer('per_page', 10))
        );
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProduct $request)
    {
        $data = $request->validated();
        try {
            $product = $this->productService->store($request->validated());
            return response()->json($product, 201);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Failed to create product'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($product)
    {
        try{
            $this->productService->destroy($product);
            return response()->json(['message' =>'Product Deleted'],200);
        }
        catch(\Throwable $e) {
            return response()->json(['message' => 'Failed to Destroy product'], 500);
        }
    }
}
