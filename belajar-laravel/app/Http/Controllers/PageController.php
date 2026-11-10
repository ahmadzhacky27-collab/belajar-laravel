<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Blog;
use App\Models\CategoryBlog;

class PageController extends Controller
{
    public function faq()
    {
        return view('faq.index');
    }

    public function contact()
    {
        $setting = Setting::get();
        return view('contact.index', compact('setting'));
    }

    public function blog()
    {
        $categories = CategoryBlog::withCount('blogs')->get();
        $totalBlogsCount = Blog::count();
        $blogs = Blog::with('blogCategory')->orderBy('id', 'desc')->get();

        return view('blog.index', compact('blogs', 'categories', 'totalBlogsCount'));
    }

    public function showBlog($slug)
    {
        $blog = Blog::where('slug', $slug)->with('blogCategory')->firstOrFail();

        return view('blog.show', compact('blog'));
    }
}
