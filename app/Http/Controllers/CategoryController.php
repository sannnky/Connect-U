<?php

namespace App\Http\Controllers;

use App\Models\categories;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Menampilkan daftar semua kategori.
     */
    public function index()
    {
        $categories = categories::all();
        return view('categories.index', compact('categories'));
    }

    /**
     * Menampilkan detail satu kategori beserta proyek/event terkait.
     */
    public function show(Categories $category)
    {
        // Anda bisa menambahkan relasi lain jika ada, contoh: 'discussions'
        $category->load('projects', 'events'); 
        return view('categories.show', compact('category'));
    }
}
