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

    <div class="p-2 text-white d-none d-md-inline" data-controller="current-time">
        <span data-target="current-time.day">-</span>
        <span data-target="current-time.month">-</span>,
        <strong data-target="current-time.week">-</strong>,
        <span data-target="current-time.hours">-</span>
        <span class="blinker">:</span>
        <span data-target="current-time.minutes">-</span>
    </div>
</div>
