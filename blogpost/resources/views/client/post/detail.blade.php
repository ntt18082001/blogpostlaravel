<x-client.client-layout title="{{$data->title}}">
    <div class="row">
        <div class="col-md-8">

        </div>
        <div class="col-md-4">
            <x-client.related-post id="{{$data->id}}" />
        </div>
    </div>
</x-client.client-layout>
