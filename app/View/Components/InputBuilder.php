<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputBuilder extends Component
{
    public $fields;

    /**
     * Create a new component instance.
     *
     * @param array $fields Array of field definitions (e.g., from the database)
     */
    public function __construct($fields)
    {
        $this->fields = $fields;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input-builder');
    }
}
