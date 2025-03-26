<?php
namespace App\Livewire;

use App\Models\Category;
use App\Models\Ticket;
use Livewire\Component;

class TicketForm extends Component
{
    public $subject;
    public $category_id = 0;
    public $description;
    public $categoryFields = []; // Dynamic fields for the selected category
    public $dynamicInputs = []; // User inputs for dynamic fields

    protected $rules = [
        'subject' => 'required|max:255',
        'category_id' => 'required|integer|exists:categories,id',
        'description' => 'required',
    ];

    public function updatedCategoryId($value)
    {
        // Fetch category-specific fields when a category is selected
        $category = Category::find($value);
        $this->categoryFields = $category ? $category->inputs : [];
        foreach ($this->categoryFields as $field) {
            if ($field->options) {
                $this->dynamicInputs[$field['field_name']] = [];
            }
        }
        $this->resetValidation(); // Clear validation errors when category changes
    }

    public function submitForm()
    {
        // Base validation for ticket inputs
        $this->validate();

        // Add dynamic validation for category fields
        $dynamicRules = [];

        foreach ($this->categoryFields as $field) {
            $rule = [];

            if ($field->is_required) {
                $rule[] = 'required';
            }

            switch ($field->field_type) {
                case 'text':
                case 'textarea':
                    $rule[] = 'string';
                    break;
                case 'select':
                case 'radio':
                    $rule[] = 'in:' . implode(',', json_decode($field->options, true));
                    break;
                case 'checkbox':
                    $rule[] = 'array';
                    break;
                default:
                    $rule[] = 'nullable';
                    break;
            }

            $dynamicRules["dynamicInputs.{$field->field_name}"] = implode('|', $rule);
        }

        $this->validate($dynamicRules);

        // Save the ticket
        $ticket = Ticket::create([
            'user_id' => auth()->id(),
            'subject' => $this->subject,
            'category_id' => $this->category_id,
            'description' => $this->description,
            'custom_data' => json_encode($this->dynamicInputs),
        ]);

        session()->flash('success', 'Ticket created successfully.');
        return redirect()->route('tickets.show', $ticket->id);
    }

    public function render()
    {
        return view('livewire.ticket-form', [
            'categories' => Category::all(),
        ]);
    }
}

