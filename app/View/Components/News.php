<?php

namespace App\View\Components;

use Illuminate\View\Component;

class News extends Component
{
    /**
     * @var string|null
     */
    public $image;

    /**
     * @var string
     */
    public $internalLink;

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
     * Create a new component instance.
     *
     * @param News $news
     */
    public function __construct(\App\News $news)
    {
        $this->title = $news->title;
        $this->domain = $news->domain;
        $this->favicon = $news->favicon;
        $this->image = $news->image;
        $this->internalLink = $news->internalLink;
        $this->pubDate = $news->pubDate;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.news');
    }
}
