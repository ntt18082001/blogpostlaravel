<h4>Related Post</h4>
@foreach($data as $item)
    <div class="card" style="width: 18rem;">
        <a href="{{route('client.post.detail', ['id' => $item->id])}}">
            <img src="/storage/post/{{$item->cover_path}}" class="card-img-top" alt="...">
        </a>
        <div class="card-body">
            <a href="{{route('client.post.detail', ['id' => $item->id])}}">
                <h5 class="card-title">{{$item->title}}</h5>
            </a>
            <p class="card-text">{{$item->summary}}</p>
        </div>
    </div>
@endforeach
