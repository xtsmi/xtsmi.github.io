<div class="card border-0 mb-3">
    <div class="row no-gutters">
        <div class="col-md-5">
            {{-- Вынести --}}
            @php $find = false @endphp
            @foreach($group as $new)
                @if(!empty($new->image) && $find === false)
                    <img
                        src="{{ $new->image }}"
                        class="img-full border"
                        alt="{{$new->title}}"
                    >
                    @php $find = true @endphp
                @endif
            @endforeach
        </div>
        <div class="col-md-7 d-flex">
            <div class="px-md-4 m-auto">
                <h2 class="text-dark font-weight-bolder">{{$title}}</h2>
            </div>
        </div>
    </div>
</div>

<hr>
