@extends('layouts.master')

@section('content')
    <h1>Editar un producto</h1>

    <form
        method="POST"
        action="{{ route('products.update',['product' => $product->id]) }}"
        enctype="multipart/form-data"
        >
        @csrf
        @method('PUT')
        <div class="form-row">
            <label>Titiulo</label>
            <input class="form-control" type="text" name="title" value="{{ old ('title')?? $product->title}}" required>
        </div>
        <div class="form-row">
            <label>Descripcion</label>
            <input class="form-control" type="text" name="description" value="{{ old ('description')?? $product->description }}" required>
        </div>
        <div class="form-row">
            <label>Precio</label>
            <input class="form-control" type="number" min="1.00" step="0.01" name="price" value="{{old ('price')?? $product->price }}" required>
        </div>
        <div class="form-row">
            <label>Stock</label>
            <input class="form-control" type="number" min="0" name="stock" value="{{old ('stock')?? $product->stock }}" required>
        </div>
        <div class="form-row">
            <label>Estado</label>
            <select class="custom-select" name="status" required>
            <option {{ old('status') == 'available' ? 'selected' : ($product->status == 'available' ? 'selected' : '') }} value="available">
                    Activo
                </option>

                <option {{ old('status') == 'unavailable' ? 'selected' : ($product->status == 'unavailable' ? 'selected' : '') }} value="unavailable">
                    Inactivo
                </option>
            </select>
        </div>
        
        <div class="form-row mt-3">
            <button type="submit" class="btn btn-primary btn-lg"> Editar</button>
        </div>
    </form>
@endsection