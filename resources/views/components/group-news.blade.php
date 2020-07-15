<div class="read bg-white pt-3 px-3 mb-4 rounded shadow-sm" data-target="main.groupsItem">
    @include('particles/group_header')

    <div class="row py-md-3 row-cols-xl-3 row-cols-sm-2 row-cols-sm-1">
        @foreach($group->take(3) as $new)
            @include('particles/group_item', $new->toArray())
        @endforeach
    </div>
</div>
