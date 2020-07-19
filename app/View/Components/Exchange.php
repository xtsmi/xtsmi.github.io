<?php

namespace App\View\Components;

use App\Source;
use Illuminate\View\Component;

class Exchange extends Component
{
    /**
     * @var \Illuminate\Support\Collection|\Illuminate\Support\HigherOrderCollectionProxy
     */
    public $exchange;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->exchange = Source::getExchange();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.exchange');
    }

    /**
     * @param array $currency
     *
     * @return float
     */
    public function difference(array $currency): float
    {
        return $currency['value'] - $currency['previous'];
    }

    /**
     * @param float $value
     *
     * @return float
     */
    public function format(float $value): float
    {
        return number_format($value, 2);
    }

    /**
     * @param array $currency
     *
     * @return bool
     */
    public function isPositiveDynamics(array $currency): bool
    {
        $value = $this->difference($currency);

        return $value === abs($value);
    }
}
