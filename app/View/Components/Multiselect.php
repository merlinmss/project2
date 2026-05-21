<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Multiselect extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public string $label = '',
        public array $options = [],
        public array $selected = [],
        public bool $required = false,
    ) { }

    public function render()
    {
        return view('components.multiselect');
    }
}
