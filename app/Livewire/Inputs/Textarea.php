<?php

namespace App\Livewire\Inputs;

use Livewire\Attributes\Modelable;
use Livewire\Component;

class Textarea extends Component
{
    public $name;
    #[Modelable]
    public $value = "";
    public $label;
    public bool $required;

    public function render()
    {
        return view('components.inputs.textarea');
    }
}
