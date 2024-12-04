<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StatsCard extends Component
{
    public $title;
    public $value;
    public $icon;
    public $bgColor;

    /**
     * Create a new component instance.
     *
     * @param  string  $title
     * @param  string  $value
     * @param  string  $icon
     * @param  string  $bgColor
     * @return void
     */
    public function __construct($title, $value, $icon, $bgColor)
    {
        $this->title = $title;
        $this->value = $value;
        $this->icon = $icon;
        $this->bgColor = $bgColor;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.stats-card');
    }
}
