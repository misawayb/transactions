<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $typeIncomes = $categories->where('type', '収入');
        $typeExpenses = $categories->where('type', '支出');

        return view('category.index',compact('categories','typeIncomes','typeExpenses'));
    }

    public function store(CategoryRequest $request)
    {
        $category = $request ->only('name','type');
        Category::create($category);

        return redirect()->route('category.index')->with('success', 'カテゴリを追加しました');
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $data= $request ->only('name','type');
        $category->update($data);

        return redirect()->route('category.index')->with('success', '更新しました');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('category.index')->with('success', '削除しました');
    }
}
