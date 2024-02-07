<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DropdownMenu extends Component
{
    public $items;
    public $buttonText;

    public function __construct($items = [], $buttonText = 'Toggle Menu')
    {
        $this->items = $items;
        $this->buttonText = $buttonText;
    }

    public function render()
    {
        return view('components.dropdown-menu');
    }
}
