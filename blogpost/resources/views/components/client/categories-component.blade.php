<div class="dropdown-menu">
    @foreach ($data as $item)
        <a class="dropdown-item" href="{{ route('client.category.index', ['id' => $item->id]) }}">{{ $item->cate_name }}</a>
    @endforeach
</div>
