<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {   
        $products= Product::all();
        //$products = DB::table('products')->get();
        //return $products;
        return view('products.index')->with([
            'products' => $products,
        ]);
    }
    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
    
    public function store()
    {
        //
    }
    
    public function show($product)
    {   
        $product= Product::findOrFail($product);
        //$products = DB::table('products')->where('id', $product)->first();
        //dd($products);
        return view('products.view')->with([
            'product' => $product,
        ]);
    }

    public function edit($product)
    {
        return "editando el formulario para editar con el id {$product}";
    }

    public function update($product)
    {
        return "actualizando el formulario para editar con el id {$product}";
    }
    public function destroy($product)
    {
        //
    }
   
}

