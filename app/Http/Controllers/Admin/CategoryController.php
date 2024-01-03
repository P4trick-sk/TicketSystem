<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryType;
use App\Models\UserCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $categories = Category::all();

        return view('admin.categories.index')->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create')->with('categoryTypes', CategoryType::where('status', 'active')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $categories = CategoryType::where('status', 'active')->pluck('id')->toArray();
        $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique(Category::class)],
            'category_type' => ['required', 'string', Rule::in($categories)],
        ]);

        $category = Category::create([
            'name' => $request->name,
            'category_type' => $request->category_type,
        ]);

        return to_route('admin.categories.edit', $category->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit')->with([
            'category' => $category,
            'categoryTypes' => CategoryType::where('status', 'active')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $categories = CategoryType::where('status', 'active')->pluck('id')->toArray();
        $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique(Category::class)->ignore($category->id)],
            'category_type' => ['required', 'int', Rule::in($categories)],
        ]);

        $category->fill($request->only('name', 'category_type'));
        $category->updated_on = now();
        $category->save();

        return to_route('admin.categories.edit', $category->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return to_route('admin.categories.index');
    }
}
