<?php

namespace App\Http\Controllers\MVC;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Requests\StoreProduct;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditProduct;

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
    public function show(Product $product)
    {
        try {
            $pharmacies = $this->productService->getProductPharmacies($product);
            $product = $this->productService->show($product);
            return view('products.show',compact('product','pharmacies'));
        } catch (\Throwable $e) {
            return redirect()->back()->with( ['error'=>'Product Does not exists'] );
        }
    }
    public function create(){
        return view('products.store');
    }
    public function store(StoreProduct $request)
    {
        $data = $request->validated();
        try {
            $product = $this->productService->store($request->validated());
            return redirect()->route('products.create')
            ->with(['success'=>"New product - {$product->title} - added successfully"]);

        } catch (\Throwable $e) {
            return redirect()->back()->with(['error'=>'can not create new product']);
        }
    }

    public function edit(Product $product){
        return view('products.edit',compact('product'));
    }
    public function update(EditProduct $request,Product $product){
        $data = $request->validated();

        $this->productService->update($product, $data);

        return redirect()->route('products.edit',$product)->with(['success'=>"Product Updated Successfully"]);
    }

    public function destroy(Product $product)
    {
        try {
            $this->productService->destroy($product);
            return redirect()->route('products')->with(['success' => 'Product Deleted Successfully']);
        } catch (\Throwable $e) {
            return redirect()->route('products')->with(['error' => 'Failed to Destroy product']);
        }
    }
}
