<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
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
        'title',
        'pubDate',
        'description',
        'link',
        'media',
        'internalLink',
    ];

    /**
     * @var array
     */
    protected $appends = [
        'id',
        'favicon',
        'domain',
        'image',
        'internalLink',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'title'       => 'string',
        'pubDate'     => 'datetime',
        'description' => 'string',
        'link'        => 'string',
        'media'       => 'array',
        'domain'      => 'string',
        'favicon'     => 'string',
        'image'       => 'string',
    ];

    /**
     * @return string
     */
    public function getDomainAttribute(): string
    {
        return parse_url($this->link, PHP_URL_HOST);
    }

    /**
     * @return string
     */
    public function getFaviconAttribute(): string
    {
        return 'https://www.google.com/s2/favicons?domain=' . $this->domain;
    }

    /**
     * @return string|null
     */
    public function getImageAttribute(): ?string
    {
        if (empty($this->media)) {
            return '';
        }

        $media = collect($this->media)->filter(function (array $info) {
            if (!isset($info['type'], $info['url'])) {
                return false;
            }

            return Str::contains($info['type'], 'image');
        })->first();

        return $media['url'] ?? '';
    }

    /**
     * @return string|null
     */
    public function getIdAttribute(): ?string
    {
        return Base64Url::encode($this->link);
    }

    /**
     * @return string
     */
    public function getInternalLinkAttribute(): string
    {
        return route('news', $this->id);
    }

    /**
     * @return array|FeedItem
     */
    public function toFeedItem()
    {
        return FeedItem::create()
            ->id($this->id)
            ->title($this->title)
            ->summary(
                Str::before(strip_tags($this->description ?? $this->title), '.')
            )
            ->enclosure($this->image)
            ->enclosureType('image')
            ->enclosureLength(0)
            ->updated($this->pubDate)
            ->author($this->domain)
            ->link($this->internalLink);
    }

    /**
     * @return mixed
     */
    public static function getFeedItems()
    {
        return Source::getSimilarNews()->map(function (Collection $group) {
            return $group->get('main');
        })->take(4);
    }
}
