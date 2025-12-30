<?php

namespace App\Http\Controllers\MVC;

use Illuminate\Http\Request;
use App\Services\ProductService;
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
        $products=$this->productService->all(
                $request->query('search'),
                $request->query('per_page', 12)
            );
        return view('products.index',compact('products'));
    }
}
