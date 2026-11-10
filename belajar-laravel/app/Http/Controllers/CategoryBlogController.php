<?php

namespace App\Http\Controllers;

use App\Models\CategoryBlog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryBlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Management Kategori Blog";
        $categories = CategoryBlog::orderBy('id')->get();
        return view('admin.category_blog.index', compact('title', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Tambah Kategori || PPKD Sticker";
        return view('admin.category_blog.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'slug' => 'nullable|string|unique:categories,slug,',
        ]);

        $validated['slug'] = $validated['slug'] ? Str::slug($validated['slug']) : Str::slug($validated['name']);
        CategoryBlog::create($validated);
        return redirect()->route('admin.category_blog.index')->with('success', 'Kategori Blog berhasil ditambahkan');
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
    public function edit(CategoryBlog $categoryBlog)
    {
        $title = 'Edit Kategori Blog || PPKD Sticker';
        return view('admin.category_blog.edit', compact('title', 'categoryBlog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CategoryBlog $categoryBlog)

    {
        $validated = $request->validate([
            'name' => 'required|string',
            'slug' => 'nullable|string|unique:categories,slug,' . $categoryBlog->id,
        ]);

        $validated['slug'] = $validated['slug'] ? Str::slug($validated['slug']) : Str::slug($validated['name']);
        $categoryBlog->update($validated);

        return redirect()->route('admin.category_blog.index')->with('success', 'Kategori Blog berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoryBlog $categoryBlog)
    {
        $categoryBlog->delete();
        // Category::find($id)->delete(); pake params string $id
        // Category::where('id', $id)->delete
        return redirect()->route('admin.category_blog.index')->with('success', 'Kategori Blog berhasil dihapus!');
    }
}
