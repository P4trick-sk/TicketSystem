<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Models\CategoryType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorytypes = CategoryType::paginate(5);
        return view('admin.categoryTypes.index')->with('categoryTypes', $categorytypes);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categoryTypes.create')->with([
            'teachers' => User::whereIn('role', [UserRole::Teacher, UserRole::Admin])->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $teachers = User::whereIn('role', [UserRole::Teacher, UserRole::Admin])->pluck('id')->toArray();
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'assigned_to' => ['required', 'int', Rule::in($teachers)],
            'is_dynamic' => ['required', 'int'],
        ]);

        $categoryType = CategoryType::withTrashed()->updateOrCreate(
            ['name' => $request->name],
            ['assigned_to' => $request->assigned_to, 'is_dynamic' => $request->is_dynamic,'status' => 'active', 'deleted_at' => null]
        );

        return to_route('admin.category.types.edit', $categoryType->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CategoryType $categoryType)
    {
        return view('admin.categoryTypes.edit')->with([
            'type' => $categoryType,
            'teachers' => User::whereIn('role', [UserRole::Teacher, UserRole::Admin])->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CategoryType $categoryType)
    {
        $teachers = User::whereIn('role', [UserRole::Teacher, UserRole::Admin])->pluck('id')->toArray();
        $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique(CategoryType::class)->ignore($categoryType->id)],
            'assigned_to' => ['required', 'int', Rule::in($teachers)],
            'is_dynamic' => ['required', 'int'],
        ]);

        $categoryType->fill($request->only('name', 'assigned_to', 'is_dynamic'));
        $categoryType->updated_on = now();
        $categoryType->save();

        return to_route('admin.category.types.edit', $categoryType->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoryType $categoryType)
    {
        $categoryType->delete();
        return to_route('admin.category.types.index');
    }
}
