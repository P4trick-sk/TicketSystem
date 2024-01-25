<?php

namespace App\Http\Requests;

use App\Models\Category;
use App\Models\Classroom;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class StoreTicketRequest extends FormRequest
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
            'subject' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:2000'],
            'category_id' => ['required', Rule::in($categories)],
            'classroom_id' => ['nullable', Rule::in($classrooms)],
            'attachment' => [File::image()->max('10mb')],
        ];
    }
}
