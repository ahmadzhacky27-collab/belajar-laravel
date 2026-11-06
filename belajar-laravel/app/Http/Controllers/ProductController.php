<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Manajemen Produk || PPKD Sticker';
        $products = Product::with('category')->get();

        return view('admin.product.index', compact('title', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Product || PPKD Sticker';
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
            'cutting_price' => 'nullable|numeric',

            'images' => 'nullable|array',
            'images.*' => 'image|mimes:png,jpg,jpeg,webp|max:2048',
            'alt' => 'nullable|array',
            'alt.*' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
        ]);

        // Buat slug otomatis jika kosong
        $slug = !empty($validated['slug']) ? Str::slug($validated['slug']) : Str::slug($validated['name']);

        DB::transaction(function () use ($request, $validated, $slug) {
            $product = Product::create([
                'category_id' => $validated['category_id'],
                'name' => $validated['name'],
                'image' => null,
                'slug' => $slug,
                'price' => $validated['price'],
                'brief_description' => $validated['brief_description'] ?? null,
                'description' => $validated['description'] ?? null,
                'price_art_cartoon' => $validated['price_art_cartoon'] ?? null,
                'price_art_paper' => $validated['price_art_paper'] ?? null,
                'price_hvs' => $validated['price_hvs'] ?? null,
                'price_doff' => $validated['price_doff'] ?? null,
                'price_glossy' => $validated['price_glossy'] ?? null,
                'cutting_price' => $validated['cutting_price'] ?? null,
            ]);

            if ($request->hasFile('images')) {
                $imageData = [];
                $firstImageData = null;

                foreach ($request->file('images') as $key => $file) {
                    $path = $file->store('products', 'public');
                    if ($key === 0) {
                        $firstImageData = $path;
                    }

                    // Perbaikan petik ganda untuk interpolasi string $key
                    $imageData[] = [
                        'path' => $path,
                        'alt' => $request->input("alt.{$key}") ?? $product->name,
                        'sort_order' => $key + 1,
                    ];
                }

                // Pastikan relasi images() sudah ada di model Product jika menggunakan baris ini
                if (method_exists($product, 'images')) {
                    $product->images()->createMany($imageData);
                }

                if ($firstImageData) {
                    $product->update([
                        'image' => $firstImageData
                    ]);
                }
            }
        });

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
        $product = Product::findOrFail($id);

        // Diperbaiki dari $product->img menjadi $product->image
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();
        return redirect()->route('admin.product.index')->with('success', 'Product berhasil dihapus!');
    }
}
