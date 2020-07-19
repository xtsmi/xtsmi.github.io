<div class="my-2 my-md-0">

    @foreach($exchange as $currency)
        <span class="p-2 text-white" title="{{ $currency['name'] }}">
            <span class="text-muted">{{ $currency['charCode'] }}:</span>

            {{ $format($currency['value']) }}

            <span class="{{ $isPositiveDynamics($currency) ? ' text-success' : 'text-danger' }} d-none d-md-inline">
                {!!   $isPositiveDynamics($currency) ? '&#8593;' : '&#8595;' !!}
                {{ $format($difference($currency)) }}
            </span>
        </span>

    @endforeach

    <span class="p-2 text-white d-none d-md-inline">
       11 июля, <strong>суббота</strong>, 15<span class="blinker">:</span>47
    </span>
</div>
