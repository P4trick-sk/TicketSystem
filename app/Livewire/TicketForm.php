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
    public $categoryInputs = []; // Dynamic fields for the selected category
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
        $this->categoryInputs = $category ? $category->inputs : [];
        foreach ($this->categoryInputs as $field) {
            if ($field->options) {
                $this->dynamicInputs[$field['field_name']] = [];
            }
        }
        $this->resetValidation(); // Clear validation errors when category changes
    }

    /**
     * Submit the ticket form.
     *
     * Available fields:
     * - subject: string, required, max: 255
     * - category_id: integer, required, exists in categories
     * - description: string, required
     * - dynamicInputs: array, contains user inputs for dynamic fields:
     *      - field_name: string, required if field is required, type based on field_type
     *      - field_type: string, determines validation rules (text, textarea, select, radio, checkbox)
     *
     * @return void
     */
    public function submitForm()
    {
        // Base validation for ticket inputs
        $this->validate();

        // Add dynamic validation for category fields
        $dynamicRules = [];

        foreach ($this->categoryInputs as $input) {
            $rule = [];

            if ($input->is_required) {
                $rule[] = 'required';
            }

            switch ($input->field_type) {
                case 'text':
                case 'textarea':
                    $rule[] = 'string';
                    break;
                case 'select':
                case 'radio':
                    $rule[] = 'in:' . implode(',', $input->options);
                    break;
                case 'checkbox':
                    $rule[] = 'array';
                    break;
                default:
                    $rule[] = 'nullable';
                    break;
            }

            $dynamicRules["dynamicInputs.{$input->field_name}"] = implode('|', $rule);
        }

        $this->validate($dynamicRules);

        // Save the ticket
        $ticket = Ticket::create([
            'user_id' => auth()->id(),
            'subject' => $this->subject,
            'category_id' => $this->category_id,
            'description' => $this->description,
            'custom_data' => $this->dynamicInputs,
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

