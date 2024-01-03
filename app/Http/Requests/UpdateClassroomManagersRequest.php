<?php

namespace App\Http\Requests;

use App\Enums\UserRole;
use App\Models\CategoryType;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateClassroomManagersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $teachers = User::whereIn('role', [UserRole::Teacher, UserRole::Admin])->pluck('id')->toArray();
        array_push($teachers, 0);
        $managableTypes = CategoryType::where('is_dynamic', true)->get();
        $rules = [];

        foreach ($managableTypes as $type)
        {
            $rules['type-'. $type->id] = ['required', 'int', Rule::in($teachers)];
        }

        return $rules;
    }
}
