<?php

namespace App\Livewire;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class CreateTicketForm extends Component
{
    public $categoryId = 0;
    public Collection $inputs;

    public function render()
    {
        $categories = Category::all();
        $this->updateInputs(); // Called on render, so there are relatable inputs at start.
        return view('livewire.create-ticket-form')->with('categories', $categories)->layout('layouts.app');
    }

    public function updated()
    {
        $this->updateInputs();
    }

    /**
     * Method is called on categoryId update to get category's inputs.
     */
    public function updateInputs()
    {
        /**
         * If categoryId isn't located in the DB, this prevents accessing inputs on null.
         */
        $category = Category::find($this->categoryId);
        if ($category) {
            $this->inputs = $category->inputs;
        } else {
            $this->inputs = new Collection();
        }
    }
}
