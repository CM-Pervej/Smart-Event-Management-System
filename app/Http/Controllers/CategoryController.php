<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::orderBy('name')->get();
        return view('events.categories', compact('categories'));
    }

    public function store(Request $request){
        $request->validate([
            'name'  => 'required|string|max:255|unique:categories,name',
        ]);

        Category::create([
            'name'  =>$request->name,
        ]);

        return back()->with('success', 'New Category added successfully!');
    }

    public function update(Request $request, $id){
        $request->validate([
            'name'  => 'required|string|max:255|unique:categories,name', 
        ]);

        $category = Category::findOrFail($id);
        $category->update([
            'name'  => $request->name,
        ]);

        return back()->with('success', 'Category updated successfully!');
    }

    public function destroy($id){
        Category::findOrFail($id)->delete();
        return back()->with('success', 'Category deleted!');
    }
}
