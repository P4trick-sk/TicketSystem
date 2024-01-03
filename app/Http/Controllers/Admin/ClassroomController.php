<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Models\CategoryType;
use App\Models\Classroom;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classrooms = Classroom::all();
        return view('admin.classrooms.index')->with('classrooms', $classrooms);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.classrooms.create')->with('teachers', User::whereIn('role', [UserRole::Teacher, UserRole::Admin])->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:'.Classroom::class],
            'room_manager' => ['required', 'int'],
            'technical_manager' => ['required', 'int'],
        ]);

        $classroom = Classroom::create([
            'name' => $request->name,
            'room_manager' => $request->room_manager,
            'technical_manager' => $request->technical_manager,
        ]);

        return to_route('admin.classrooms.edit', $classroom->id);
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
    public function edit(Classroom $classroom)
    {
        return view('admin.classrooms.edit')->with([
            'classroom' => $classroom,
            'managableTypes' => CategoryType::where('is_dynamic', true)->get(),
            'teachers' => User::whereIn('role', [UserRole::Teacher, UserRole::Admin])->get(),
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classroom $classroom)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique(Classroom::class)->ignore($classroom->id)],
        ]);

        $classroom->fill($request->only('name'));
        $classroom->updated_on = now();
        $classroom->save();

        return to_route('admin.classrooms.edit', $classroom->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $classroom)
    {
        $classroom->delete();
        return to_route('admin.classrooms.index');
    }
}
