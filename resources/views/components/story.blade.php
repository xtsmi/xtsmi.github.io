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
    <div class="col d-flex">
        <div class="px-md-4 m-auto">
            <h2 class="text-dark font-weight-bolder">{{$title}}</h2>
        </div>
    </div>
</div>

<hr>
