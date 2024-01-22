<?php

namespace App\Http\Requests;

use App\Enums\UserRole;
use App\Models\Category;
use App\Models\Classroom;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAdvancedTicketInfoRequest extends FormRequest
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
        $classrooms = Classroom::all()->pluck('id')->toArray();
        $categories = Category::all()->pluck('id')->toArray();

        array_push($classrooms, null);

        return [
            'priority' => ['required', Rule::in(['low', 'medium', 'high'])],
            'category_id' => ['required', Rule::in($categories)],
            'classroom_id' => ['nullable', Rule::in($classrooms)],
        ];
    }
}
