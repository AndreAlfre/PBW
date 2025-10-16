<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    // Menampilkan daftar posts
    public function index()
    {
        return view('posts.index');
    }

    // Menampilkan form create post
    public function create()
    {
        return view('posts.create');
    }

    // Menyimpan post baru
    public function store(Request $request)
    {
        // Logic untuk menyimpan post
        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }

    // Menampilkan detail post
    public function show($id)
    {
        return view('posts.show');
    }

    // Menampilkan form edit post
    public function edit($id)
    {
        return view('posts.edit');
    }

    // Update post
    public function update(Request $request, $id)
    {
        // Logic untuk update post
        return redirect()->route('posts.index')->with('success', 'Post updated successfully!');
    }

    // Hapus post
    public function destroy($id)
    {
        // Logic untuk delete post
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully!');
    }
}