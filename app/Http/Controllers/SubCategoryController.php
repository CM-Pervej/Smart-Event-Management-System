<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index(){
        $subCategories = SubCategory::with('category')->orderBy('name')->get();
        $categories    = Category::orderBy('name')->get();
        return view('events.subcategories', compact('subCategories', 'categories'));
    }

    public function store(Request $request){
        $request->validate([
            'name'  => 'required|string|max:255|unique:categories,name',
            'category_id'   => 'required|exists:categories,id',
        ]);

        SubCategory::create( $request->only('name', 'category_id'));

        return back()->with('success', 'New Sub-category added successfully!');
    }

    public function update(Request $request, $id){
        $request->validate([
            'name'  => 'required|string|max:255|unique:categories,name',
            'category_id' => 'required|exists:categories,id',
        ]);

        $subCategory = SubCategory::findOrFail($id);
        $subCategory->update($request->only('name', 'category_id'));

        return back()->with('success', 'Sub-category updated successfully');
    }

    public function destroy($id){
        SubCategory::findOrFail($id)->delete();
        return back()->with('success', 'Sub-category deleted!');
    }
}
