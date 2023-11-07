<x-client.client-layout title="{{$data->title}}">
    <div class="row">
        <div class="col-md-8">
            <p>Posted by: {{$data->author->full_name}} | Posted at: {{$data->created_at}}</p>
            <div class="content-blog">
                {!! $data->content !!}
            </div>
        </div>
        <div class="col-md-4">
            <x-client.related-post id="{{$data->id}}" />
        </div>
    </div>
</x-client.client-layout>
