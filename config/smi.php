<?php

return [

    /*
    |--------------------------------------------------------------------------
    | File generated
    |--------------------------------------------------------------------------
    |
    | A value indicating when the records were generated
    |
    */

    'generated' => env('APP_GENERATED', LARAVEL_START),


    /*
    |--------------------------------------------------------------------------
    | Time Period
    |--------------------------------------------------------------------------
    |
    | The time period for which it is necessary to take news
    | Indicate in hours: 1,2..n
    |
    */

    'period' => 12,

    /*
    |--------------------------------------------------------------------------
    | Story
    |--------------------------------------------------------------------------
    |
    | Options for defining similar articles and combining them
    |
    */

    'story'  => [
        'percent'  => 75,
        'minCount' => 3,
    ],

    /*
    |--------------------------------------------------------------------------
    | News
    |--------------------------------------------------------------------------
    |
    | Options ...
    |
    */

    'news'  => [
        'renderCount' => 10,
    ],

    /*
    |--------------------------------------------------------------------------
    | RSS Feed
    |--------------------------------------------------------------------------
    |
    | ...
    |
    */

    'rss' => [
        // smi
        'https://www.vedomosti.ru/rss/news',
        'http://www.aif.ru/rss/news.php',
        'http://lenta.ru/rss/',
        'http://www.rian.ru/export/rss2/index.xml',
        'http://russian.rt.com/rss/',
        'https://www.gazeta.ru/export/rss/lenta.xml',
        'http://www.aif.ru/rss/news.php',
        'http://www.kommersant.ru/RSS/news.xml',
        'http://vz.ru/rss.xml',
        'http://www.vedomosti.ru/newsline/out/rss.xml',
        'http://tass.ru/rss/v2.xml?sections=MjU%3D',
        'http://www.vesti.ru/vesti.rss',
        'https://www.mk.ru/rss/news/index.xml',
        'https://tvrain.ru/export/rss/all.xml',
        'https://meduza.io/rss/news',
        'https://tjournal.ru/rss',
        'https://zona.media/rss',
        'https://rtvi.com/rss',
        'https://dailystorm.ru/media/rss.xml',
        'https://360tv.ru/rss/',
        'https://www.interfax.ru/rss.asp',
        'https://www.forbes.ru/newrss.xml',
        //'https://ura.news/rss',
        'https://www.znak.com/rss',
        'https://takiedela.ru/feed',
        'https://regnum.ru/rss/russian/',
        'https://rg.ru/xml/index.xml',
        'https://www.ng.ru/rss/',
        'https://www.rosbalt.ru/feed/',
        'https://rtvi.com/rss/',
        'https://life.ru/rss',
        'https://vz.ru/rss.xml',
        'https://www.ridus.ru/rss/news',
        'https://istories.media/rss/all.xml',
        'https://www.fontanka.ru/rss.xml',
        'https://regnum.ru/rss/news.html',
        'https://live24.ru/rss.xml',
        'https://takiedela.ru/feed/',
        'https://paperpaper.ru/feed/',
        'https://www.yuga.ru/articles.rss',
        'https://tayga.info/rss',
        'https://7x7-journal.ru/rss/default.xml',
        'https://mash.ru/rss',
        'https://ria.ru/export/rss2/archive/index.xml',
        'https://eadaily.com/ru/rss/index.xml',

        // foreign
        'https://gordonua.com/xml/rss_category/top.html',
        'https://nexta.news/feed/',
        'https://www.belta.by/rss',
        'https://telegraf.by/feed/',


        // blogs
        'https://varlamov.ru/data/rss'
    ],

    /*
    |--------------------------------------------------------------------------
    | Ignore
    |--------------------------------------------------------------------------
    |
    | ...
    |
    */

    'ignore' => [
        'covers' => [
            'images/zenvz.jpg', // https://vz.ru/images/zenvz.jpg
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | tags
    |--------------------------------------------------------------------------
    |
    | ...
    |
    */

    'tags' => [
        [
            'slug'     => \Illuminate\Support\Str::slug('Навальный'),
            'name'     => 'Навальный',
            'contains' => 'Навальный', 'ФБК', 'Навальн',
        ],
        [
            'slug'     => \Illuminate\Support\Str::slug('Вакцина от COVID-19'),
            'name'     => 'Вакцина от COVID-19',
            'contains' => 'коронавирус', 'ковид', 'covid', 'Спутник V', 'Спутника V',
        ],
        [
            'slug'     => \Illuminate\Support\Str::slug('Украина'),
            'name'     => 'Украина',
            'contains' => 'украи', 'Киев'
        ],
        [
            'slug'     => \Illuminate\Support\Str::slug('Беларусь'),
            'name'     => 'Беларусь',
            'contains' => 'Беларус', 'Беларус', 'Тихановск', 'Минск', 'Лукашенк'
        ],
        [
            'slug'     => \Illuminate\Support\Str::slug('Северный поток'),
            'name'     => 'Северный поток',
            'contains' => 'Северный поток',
        ],
    ],

];
