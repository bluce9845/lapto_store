<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function dashboard()
    {
        $products = Product::all();

        return view('dashboard', compact('products'));
    }

    public function detailProduct($product_id)
    {
        $product = Product::findOrFail($product_id);

        return view('detailProduct', compact('product'));
    }

    public function formAd()
    {
        return view('form.formAd');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string|max:255',
            'price' => 'required',
            'stock' => 'required|integer'
        ]);

        Product::create($validateData);

        return redirect()->route('dashboard')->with('success', 'Added data successfully!!');
    }
}
