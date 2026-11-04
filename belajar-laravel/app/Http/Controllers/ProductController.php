<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Managemen Produk || PPKD Sticker';
        $products = Product::with('category')->get();
        // $category = Category::with('products')->count();

        return view('admin.product.index', compact('title', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Product || PPKD Sricker';
        $categories = Category::get();

        return view('admin.product.create', compact('title', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */


public function store(Request $request)
{
    $validated = $request->validate([
        'category_id' => 'required|exists:categories,id',
        'name' => 'required|string|max:60',
        'slug' => 'nullable|string|max:60|unique:products,slug',
        'price' => 'required|numeric',
        'image' => 'nullable|image|mimes:png,jpg,jpeg,gif|max:2048',
        'brief_description' => 'nullable|string',
        'description' => 'nullable|string',
        'price_art_cartoon' => 'nullable|numeric',
        'price_art_paper' => 'nullable|numeric',
        'price_hvs' => 'nullable|numeric',
        'price_doff' => 'nullable|numeric',
        'price_glossy' => 'nullable|numeric',
        'price_cutting' => 'nullable|numeric',
        'price_no_cutting' => 'nullable|numeric',
    ]);
    if (empty($validated['slug'])) {
        $validated['slug'] = Str::slug($validated['name']);
    }
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('products', 'public');
        $validated['image'] = $imagePath;
    }
    Product::create($validated);
    return redirect()->route('admin.product.index')->with('success', 'Product berhasil ditambahkan!');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, string $id)
{
    $product = Product::findOrFail($id);
    $validated = $request->validate([
        'category_id' => 'required|exists:categories,id',
        'name' => 'required|string|max:60',
        'slug' => 'nullable|string|max:60|unique:products,slug,' . $product->id,
        'price' => 'required|numeric',
        'image' => 'nullable|image|mimes:png,jpg,jpeg,gif|max:2048',
        'brief_description' => 'nullable|string',
        'description' => 'nullable|string',
        'price_art_cartoon' => 'nullable|numeric',
        'price_art_paper' => 'nullable|numeric',
        'price_hvs' => 'nullable|numeric',
        'price_doff' => 'nullable|numeric',
        'price_glossy' => 'nullable|numeric',
        'price_cutting' => 'nullable|numeric',
        'price_no_cutting' => 'nullable|numeric',
    ]);

    if (empty($validated['slug'])) {
        $validated['slug'] = Str::slug($validated['name']);
    }
    if ($request->hasFile('image')) {
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        // Upload gambar baru
        $validated['image'] = $request->file('image')->store('products', 'public');
    }
    $product->update($validated);
    return redirect()->route('admin.product.index')->with('success', 'Product berhasil diupdate!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}