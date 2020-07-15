<?php

namespace App\View\Components;

use Illuminate\Support\Collection;
use Illuminate\View\Component;

class GroupNews extends Component
{
    /**
     * @var string
     */
    public $title;

    /**
     * @var Collection
     */
    public $group;

    /**
     * Create a new component instance.
     *
     * @param string     $title
     * @param Collection $group
     */
    public function __construct(string $title, Collection $group)
    {
        $this->title = $title;
        $this->group = $group;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.group-news');
    }
}
