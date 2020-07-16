<div class="card border-0 mb-3" data-target="main.groupsItem">
    <div class="row">
        @empty(!$image)
            <div class="col-12 col-md-5">
                <img
                    src="{{ $image }}"
                    class="img-full border"
                    alt="{{$title}}"
                >
            </div>
        @endempty
        <div class="col d-flex">
            <div class="px-md-4 m-auto">
                <h2 class="text-dark font-weight-bolder">{{$title}}</h2>
            </div>
        </div>
    </div>
</div>

<hr>
