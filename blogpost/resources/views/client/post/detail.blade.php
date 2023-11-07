<x-client.client-layout title="{{$data->title}}">
    <div class="row">
        <div class="col-md-8">
            <p>Posted by: {{$data->author->full_name}} | Posted at: {{$data->created_at}}</p>
            <div class="content-blog">
                {!! $data->content !!}
            </div>
            <div class="mt-3">
                <h4>Comments</h4>
                @if(\Illuminate\Support\Facades\Auth::check())
                    <form class="mt-3" method="post">
                        <input type="hidden" name="id" value="{{$data->id}}">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="content" placeholder="abc..."
                                   aria-label="Recipient's username" aria-describedby="button-addon2">
                            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Comment</button>
                        </div>
                    </form>
                    <div class="mt-3">
                        @if(count($comments) > 0)
                            @foreach($comments as $item)
                                <div class="d-flex gap-2">
                                    @if(isset($item->author->avatar))
                                        <img class="rounded-circle header-profile-user"
                                             src="/storage/avatar/{{$item->author->avatar}}" alt="Header Avatar">
                                    @else
                                        <img class="rounded-circle header-profile-user"
                                             src="{{ asset('assets/images/users/user-dummy-img.jpg') }}"
                                             alt="Header Avatar">
                                    @endif
                                    <div>
                                        <p class="my-auto mx-0"><strong>{{$item->author->full_name}}:</strong>
                                            <span>{{$item->content}}</span></p>
                                        <button class="d-inline-block btn js-reply"
                                                data-parent-id="{{$item->id}}" data-post-id="{{$data->id}}">
                                            Reply
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>No comments.</p>
                        @endif
                    </div>
                @else
                    <a href="{{route('account.login')}}" class="btn btn-light">Login to comment</a>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <x-client.related-post id="{{$data->id}}"/>
        </div>
    </div>
    <x-slot name="script">
        <script src="{{asset('js/comment.js')}}"></script>
    </x-slot>
</x-client.client-layout>
