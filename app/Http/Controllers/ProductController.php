<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // Display a listing of the products
    public function index()
    {
        $products = product::latest()->paginate(5);

        return view('products.index', compact('products'))->with(request()->input('page'));
    }

    public function create()
    {
       return view('products.create');
    }

    // Store a newly created product in the database
    public function store(Request $request)
    {
        // valadate input
        $request->validate([
            'name' => 'required',
            'detail' => 'required'
        ]);

        // create product in database
        Product::create($request->all());

        // redirect user and send friendly message
        return redirect()->route('products.index')->with('success','Product created successfully');
    }

    
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    // Update the specified product in the database
    public function update(Request $request, Product $product)
    {
        // valadate input
        $request->validate([
            'name' => 'required',
            'detail' => 'required'
        ]);

        // update product in database
        $product->update($request->all());

        // redirect user and send friendly message
        return redirect()->route('products.index')->with('success','Product updated successfully');
    }

    // Remove the specified product from the database
    public function destroy(Product $product)
    {
        // deleting  the product
        $product->delete();

        // redirect user and send friendly message
        return redirect()->route('products.index')->with('success','Product deleted successfully');
    }
}
