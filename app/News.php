<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
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
}
