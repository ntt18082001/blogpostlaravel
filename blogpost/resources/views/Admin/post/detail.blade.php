<x-admin.admin-layout title="Detail - {{$data->title}}">
    <div class="container mt-5">
        <div class="row">
                <h1 class="text-center">{{$data->title}}</h1>
                <img src="/storage/post/{{$data->cover_path}}" class="mt-3">
                <p class="mt-3">{{$data->summary}}</p>
                <div class="mt-4">
                    <h4>Author: {{$data->author->full_name}}</h4>
                    <h4>Category: {{$data->category->cate_name}}</h4>
                </div>
                <div class="mt-4">
                    {!!$data->content!!}
                </div>
        </div>
    </div>
    <div>
        <a href="{{ route('admin.post.index') }}" class="btn btn-secondary">
            Back
        </a>
    </div>
</x-admin.admin-layout>
