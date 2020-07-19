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
     * Create a new component instance.
     *
     * @param \App\News $news
     * @param bool      $direct
     */
    public function __construct(\App\News $news, bool $direct = false)
    {
        $this->title = $news->title;
        $this->domain = $news->domain;
        $this->favicon = $news->favicon;
        $this->image = $news->image;
        $this->pubDate = $news->pubDate;

        $this->link = $direct
            ? $news->link
            : $news->internalLink;
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
