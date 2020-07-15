<?php

namespace App\View\Components;

use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Story extends Component
{
    /**
     * @var string|null
     */
    public $image;

    /**
     * @var string
     */
    public $link;

    /**
     * @var string
     */
    public $favicon;

    /**
     * @var string
     */
    public $domain;

    /**
     * @var string
     */
    public $title;

    /**
     * @var
     */
    public $pubDate;

    /**
     * @var Collection
     */
    public $items;

    /**
     * Create a new component instance.
     *
     * @param Collection $story
     */
    public function __construct(Collection $story)
    {
        $main = $story->get('main');

        $this->title = $main->title;
        $this->domain = $main->domain;
        $this->favicon = $main->favicon;
        $this->image = $main->image;
        $this->link = $main->link;
        $this->pubDate = $main->pubDate;


        $this->main = $story->get('main');
        $this->items = $story->get('items');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.story');
    }
}
