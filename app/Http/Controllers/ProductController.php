<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\CssSelector\Node\FunctionNode;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {   

        return view('products.index')->with([
            'products' => Product::all(),
        ]);
    }
    public function create()
    {
        return  view('products.create');
    }
    
    public function store(ProductRequest $request)
    {   
        $product = Product::create ($request->validated());

        return redirect ()
            ->route('products.index')
            ->withSuccess("El producto con id {$product->id} fue creado");
    }
    
    public function show(Product $product)
    {   
       // $product= Product::findOrFail($product);

        return view('products.show')->with([
            'product' => $product,
        ]);
    }

    public function edit(Product $product)
    {
        return view ('products.edit')->with([
            'product'=> $product,
         ]);
    }

    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->validated());

        return redirect ()
            ->route('products.index')
            ->withSuccess("El producto con id {$product->id} fue editado");
    }
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect ()
            ->route('products.index')
            ->withSuccess("El producto  con id {$product->id} fue eliminado");

    }
   
} 