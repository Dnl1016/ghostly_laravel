<?php
namespace App\Http\Controllers;
use App\Models\Product;
use App\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\CssSelector\Node\FunctionNode;

class ProductController extends Controller
{
    {
        $this->middleware('auth');
    }
    
    public function index()
    {   
        $products= Product::all();
  
        return view('products.index')->with([
            'products' => $products,
        ]);
    }
    public function create()
    {
        return  view('products.create');
    }
    
    public function store()
    {   
        $rules =[
            'title'=>['required','max:255'],
            'description'=>['required','max:1000'],
            'price'=>['required','min:1'],
            'stock'=>['required','min:0'],
            'status'=>['required','in:available, unavailable '],
        ];

        request()->validate($rules);

        if (request()->status=='available' && request()->stock==0) {
            return redirect ()
                ->back()
                ->withInput(request()->all())
                ->withErrors('Si el producto esta disponible debe tener un stock');
        }

        $product = Product::create (request()->all());

        return redirect ()
            ->route('products.index')
            ->withSuccess("El producto con id {$product->id} fue creado");
    }
    
    public function show($product)
    {   
        $product= Product::findOrFail($product);

        return view('products.show')->with([
            'product' => $product,
        ]);
    }

    public function edit($product)
    {
        return view ('products.edit')->with([
            'product'=>Product::findOrFail($product),
         ]);
    }

    public function update($product)
    {
         $rules =[
            'title'=>['required','max:255'],
            'description'=>['required','max:1000'],
            'price'=>['required','min:1'],
            'stock'=>['required','min:0'],
            'status'=>['required','in:available, unavailable '],
        ];

        request()->validate($rules);
        $product= Product::findOrFail($product);

        $product->update(request()->all());

        return redirect ()
            ->route('products.index')
            ->withSuccess("El producto con id {$product->id} fue editado");
    }
    public function destroy($product)
    {
        $product= Product::findOrFail($product);

        $product->delete();

        return redirect ()
            ->route('products.index')
            ->withSuccess("El producto  con id {$product->id} fue eliminado");

    }
   
}
