<?php

namespace App\Livewire\Inputs;

use Livewire\Attributes\Modelable;
use Livewire\Component;

class TextInput extends Component
{
    public $name;
    #[Modelable]
    public $value = "";
    public $label;
    public bool $required;

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.inputs.text');
    }
}
