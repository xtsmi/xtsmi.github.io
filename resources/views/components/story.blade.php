<div class="row mb-3">
    @empty(!$image)
        <div class="col-12 col-md-5">
            <img
                src="{{ $image }}"
                class="img-full border bg-secondary bg-gradient-secondary"
                alt="{{$title}}"
                loading="lazy"
            >
        </div>
    @endempty
    <div class="col d-flex flex-column">
        <div class="row">
            <div class="py-3 col d-flex flex-column py-3">
                <div class="media v-center mb-1">
                    <img src="{{ $favicon }}" class="mr-2" alt="{{ $domain }}" loading="lazy">
                    <div class="media-body">{{ $domain }}</div>
                </div>
                <h2 class="text-dark font-weight-bolder">{{$title}}</h2>
            </div>
        </div>
        <div class="d-flex mt-auto">
            <div class="mr-auto">Новостей по теме: {{ count($items) }}</div>

            <button type="button" class="btn btn-sm btn-outline-primary mr-2">Читать подробнее</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Весь сюжет</button>
        </div>
    </div>
</div>

<hr>
