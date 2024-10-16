<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Textarea extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public string $label,
        public string $value = '',
        public string $placeholder = '',
        public bool $required = false,
        public bool $readonly = false,
        public bool $isVisible = true,
    ){}

    public function shouldRender(): bool
    {
        return $this->isVisible; // Will render if isVisible is true
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.textarea');
    }

}
