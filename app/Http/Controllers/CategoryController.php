<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{




    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $checkCategoryExesting = Category::where('name',$request->name)->first();
        if (!$checkCategoryExesting) {
            Category::create($request->only('name'));
            session()->flash('success', 'Category created successfully.');
        } else {
            session()->flash('error', 'Category already exists.');
        }

        return redirect()->route('adminDashboard');
    }



    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category->update($request->only('name'));

        return redirect()->route('adminDashboard')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('adminDashboard')->with('success', 'Category deleted successfully.');
    }
}
