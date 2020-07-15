<?php

namespace App\View\Components;

use App\News;
use Illuminate\View\Component;

class LastNews extends Component
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
     * @param News $news
     */
    public function __construct(News $news)
    {
        $this->title = $news->title;
        $this->domain = $news->domain;
        $this->favicon = $news->favicon;
        $this->image = $news->image;
        $this->link = $news->link;
        $this->pubDate = $news->pubDate;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.last-news');
    }
}
