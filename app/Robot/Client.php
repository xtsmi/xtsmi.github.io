<?php

declare(strict_types=1);

namespace App\Robot;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Promise;

/**
 * Class Client
 */
class Client
{
    /**
     * Guzzle client array constructor parameters.
     *
     * @var array
     */
    public $options = [
        'verify'          => false,
        'timeout'         => 10.0,
        'http_errors'     => false,
        'headers'         => [
            'User-Agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36',
            'Accept'     => '*/*',
        ],
        'allow_redirects' => [
            'max'             => 10,
            'strict'          => false,
            'referer'         => false,
            'protocols'       => ['http', 'https'],
            'track_redirects' => false,
        ],
    ];

    /**
     * Guzzle HTTP client
     *
     * @var GuzzleClient
     */
    public $client;

    /**
     * @var int
     */
    public $concurrency = 100;

    /**
     * Client constructor.
     *
     * @param array|null $options
     */
    public function __construct(array $options = null)
    {
        if (null !== $options) {
            $this->options = array_merge($this->options, $options);
        }

        $this->client = new GuzzleClient($this->options);
    }

    /**
     * @param array    $links
     * @param \Closure $fulfilled
     * @param \Closure $rejected
     */
    public function browse(array $links, \Closure $fulfilled = null, \Closure $rejected = null): void
    {
        $client = $this->client;

        $promises = (static function () use ($links, $client) {
            foreach ($links as $key => $link) {
                try {
                    yield $client->requestAsync('GET', $link);
                } catch (\Exception $exception) {
                    //записать в лог, если url не валиден
                }
            }
        })();

        (new Promise\EachPromise($promises, [
            'concurrency' => $this->concurrency,
            'fulfilled'   => $fulfilled,
            'rejected'    => $rejected,
        ]))->promise()->wait();
    }
}
