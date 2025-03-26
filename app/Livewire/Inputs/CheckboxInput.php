<?php

namespace App\Livewire\Inputs;

use Livewire\Attributes\Modelable;
use Livewire\Component;

class CheckboxInput extends Component
{
    public $name;
    #[Modelable]
    public $value = [];
    public $label;
    public bool $required;
    public $options = [];

    public function render()
    {
        return view('components.inputs.checkbox');
    }
}
