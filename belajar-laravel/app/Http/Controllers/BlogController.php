<?php

namespace App\Http\Controllers;

use App\Models\CategoryBlog;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Manajemen Blog || PPKD Sticker';
        $blogs = Blog::with('blogCategory')->get();

        return view('admin.blog.index', compact('title', 'blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Blog || PPKD Sticker';
        $categories = CategoryBlog::get();

        return view('admin.blog.create', compact('title', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blogs,slug',
            'blog_category_id' => 'required|exists:category_blogs,id',
            'brief_description' => 'nullable|string',
            'content' => 'nullable|string',
            'author' => 'nullable|string',
            'cover_path' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
        ]);

        if ($request->hasFile('cover_path')) {
            $validated['cover_path'] = $request->file('cover_path')->store('blogs', 'public');
        }

        // Ambil slug aman dari request input
        $slugInput = $request->input('slug');
        $validated['slug'] = !empty($slugInput) ? Str::slug($slugInput) : Str::slug($validated['name']);

        Blog::create($validated);

        return redirect()->route('admin.blog.index')->with('success', 'Blog berhasil ditambahkan');
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
    public function edit(Blog $blog)
    {
        $title = "Ubah Blog || PPKD Sticker";
        $categories = CategoryBlog::get();

        return view('admin.blog.edit', compact('blog', 'title', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blogs,slug,' . $blog->id,
            'blog_category_id' => 'required|exists:category_blogs,id',
            'brief_description' => 'nullable|string',
            'content' => 'nullable|string',
            'author' => 'nullable|string',
            'cover_path' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
        ]);

        if ($request->hasFile('cover_path')) {
            if ($blog->cover_path && Storage::disk('public')->exists($blog->cover_path)) {
                Storage::disk('public')->delete($blog->cover_path);
            }
            $validated['cover_path'] = $request->file('cover_path')->store('blogs', 'public');
        }

        // Ambil slug aman dari request input
        $slugInput = $request->input('slug');
        $validated['slug'] = !empty($slugInput) ? Str::slug($slugInput) : Str::slug($validated['name']);

        $blog->update($validated);

        return redirect()->route('admin.blog.index')->with('success', 'Blog berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog = Blog::findOrFail($id);

        if ($blog->cover_path && Storage::disk('public')->exists($blog->cover_path)) {
            Storage::disk('public')->delete($blog->cover_path);
        }

        $blog->delete();
        return redirect()->route('admin.blog.index')->with('success', 'Blog berhasil dihapus!');
    }
}
