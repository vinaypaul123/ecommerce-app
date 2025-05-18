<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{


   public function index(Request $request)
{
    $query = Product::query();

    if ($request->filled('search')) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    if ($request->filled('category')) {
        $query->where('category', $request->category);
    }

    if ($request->filled('min_price')) {
        $query->where('price', '>=', $request->min_price);
    }

    if ($request->filled('max_price')) {
        $query->where('price', '<=', $request->max_price);
    }

    $products = $query->latest()->paginate(9);

    // Get unique categories for the filter dropdown
    $categories = Product::select('category')->distinct()->pluck('category');

    return view('admin.products.index', compact('products', 'categories'));
}


    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only('name', 'price', 'description', 'category');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('uploads', 'public');
        }

        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Product added.');
    }
}
