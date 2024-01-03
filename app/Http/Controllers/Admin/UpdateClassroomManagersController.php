<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateClassroomManagersRequest;
use App\Models\CategoryType;
use App\Models\Classroom;
use App\Models\ClassroomManager;
use App\Models\User;
use Illuminate\Http\Request;

class UpdateClassroomManagersController extends Controller
{
    /**
     * Display the approval notice.
     */
    public function __invoke(UpdateClassroomManagersRequest $request, Classroom $classroom)
    {
        $managableTypes = CategoryType::where('is_dynamic', true)->get();

        foreach ($managableTypes as $type)
        {
            $selectedId = $request['type-'. $type->id];
            if (ClassroomManager::where('classroom_id', $classroom->id)->where('category_type_id', $type->id)->first())
            {
                if ($selectedId == 0) // default user selected
                {
                    ClassroomManager::where('classroom_id', $classroom->id)->where('category_type_id', $type->id)->delete();
                } else {
                    ClassroomManager::where('classroom_id', $classroom->id)->where('category_type_id', $type->id)->update(['assigned_to' => $selectedId]);
                }
            } else {
                if ($selectedId != 0)
                {
                    ClassroomManager::create([
                        'classroom_id' => $classroom->id,
                        'category_type_id' => $type->id,
                        'assigned_to' => $selectedId,
                    ]);
                }
            }
        }

        return to_route('admin.classrooms.edit', $classroom->id);
    }
}
