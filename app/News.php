<?php


namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;

class News extends Model implements Feedable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'pubDate', 'description', 'link',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'title'       => 'string',
        'pubDate'     => 'datetime',
        'description' => 'string',
        'link'        => 'string',
    ];

    /**
     * @return string
     */
    public function domain(): string
    {
        return parse_url($this->link, PHP_URL_HOST);
    }

    /**
     * @return string
     */
    public function favicon(): string
    {
        return 'https://www.google.com/s2/favicons?domain=' . $this->domain();
    }

    /**
     * @return array|FeedItem
     */
    public function toFeedItem()
    {
        return FeedItem::create()
            ->id(base64_encode($this->link))
            ->title($this->title)
            ->summary($this->description ?? $this->title)
            ->updated($this->pubDate)
            ->author($this->domain())
            ->link($this->link);
    }

    /**
     * @return mixed
     */
    public static function getFeedItems()
    {
        return Source::getSimilarNews()->map(function (Collection $group, string $title){
            return $group->where('title', $title)->first() ?? $group->first();
        });
    }
}
