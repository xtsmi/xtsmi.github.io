<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ExchangeRatesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rss:exchange';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download exchange rates';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $data = Http::get('https://www.cbr-xml-daily.ru/daily_json.js')->json();

        $exchange = collect()
            ->put('USD', Arr::get($data, 'Valute.USD'))
            ->put('EUR', Arr::get($data, 'Valute.EUR'))
            ->map(static function ($info) {

                $infoForCamel = [];

                foreach ($info as $key => $value) {
                    $infoForCamel[Str::camel($key)] = $value;
                }

                return $infoForCamel;
            });

        Storage::put('/api/exchange.json', $exchange->toJson());

        $this->info('Exchange Received');
    }
}
