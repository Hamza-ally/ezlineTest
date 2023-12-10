<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!auth()->user()->can('view products')) {
            abort(403, 'Unauthorized action. You do not have the required permission.');
        }
        return view('products.view');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->user()->can('create products')) {
            abort(403, 'Unauthorized action. You do not have the required permission.');
        }
        return view('products.create');
    }

    protected function validateCreateProduct(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:64'],
            'quantity' => ['required', 'string', 'max:11'],
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!auth()->user()->can('create products')) {
            return response()->json(['data' => 'Unauthorized action. You do not have the required permission.'], 403);
        }
        $this->validateCreateProduct($request->all())->validate();
        $product = new Product();
        $product->name = $request->name;
        $product->quantity = $request->quantity;
        if($product->save()){
            return response()->json(['success' => 'Product created!'], 200);
        }
        return response()->json(['error' => 'Product not created!'], 500);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        if (!auth()->user()->can('view products')) {
            return response()->json(['data' => 'Unauthorized action. You do not have the required permission.'], 403);
        }
        return response()->json(['data' => Product::all()]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        if (!auth()->user()->can('edit products')) {
            abort(403, 'Unauthorized action. You do not have the required permission.');
        }
        $product = Product::where('id', $id)->first()->toArray();
        return view('products.edit', compact('product'));
    }

    protected function validateEditProduct(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:64'],
            'quantity' => ['required', 'string', 'max:11'],
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        if (!auth()->user()->can('edit products')) {
            return response()->json(['data' => 'Unauthorized action. You do not have the required permission.'], 403);
        }
        $this->validateEditProduct($request->all())->validate();
        $product = Product::where('id', $id)->first();
        $product->name = $request->name;
        $product->quantity = $request->quantity;
        if($product->save()){
            return response()->json(['success' => 'Product updated!'], 200);
        }
        return response()->json(['error' => 'Product not updated!'], 500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product, String $id)
    {
        if (!auth()->user()->can('delete products')) {
            return response()->json(['data' => 'Unauthorized action. You do not have the required permission.'], 403);
        }
        $product = Product::where('id', $id)->first();
        if($product->delete()){
            return response()->json(['success' => 'User deleted!'], 200);
        }
        return response()->json(['error' => 'User not deleted!'], 500);
    }
}
