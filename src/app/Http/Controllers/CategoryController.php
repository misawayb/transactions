<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('category.index',compact('categories'));
    }

    public function store(Request $request)
    {
        $category = $request ->only('name','type');
        Category::create($category);

        return redirect()->route('category.index');
    }

    public function update(Request $request, Category $category)
    {
        $data= $request ->only('name','type');
        $category->update($data);

        return redirect()->route('category.index');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('category.index');
    }
}
