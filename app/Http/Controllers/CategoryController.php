<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the categories.
     */
    public function index()
    {
        $categories = \App\Models\Category::all();
        return view('categories.index', compact('categories'));
    }

    /**
     * Display the specified category.
     * 
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     * */
    public function show($id)
    {
        $category = \App\Models\Category::findOrFail($id);
        return view('categories.show', compact('category'));
    }
}
