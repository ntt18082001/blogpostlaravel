<x-client.client-layout title="{{ $data->title }}">
    <div class="row">
        <div class="col-md-8">
            <p>Posted by: {{ $data->author->full_name }} | Posted at: {{ $data->created_at }}</p>
            <div class="content-blog">
                {!! $data->content !!}
            </div>
            <div class="mt-3">
                <h4>Comments</h4>
                @if (\Illuminate\Support\Facades\Auth::check())
                    <form class="mt-3 form-comment" method="post">
                        <input type="hidden" name="post_id" value="{{ $data->id }}">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" required name="content" placeholder="abc..."
                                   aria-label="Recipient's username" aria-describedby="button-addon2">
                            <button class="btn btn-outline-secondary js-submit" type="submit" id="button-addon2">
                                Comment
                            </button>
                        </div>
                    </form>
                    <div class="mt-3 comment-container">
                        @if (count($comments) > 0)
                            @foreach ($comments as $item)
                                <div class="d-flex gap-2">
                                    @if (isset($item->author->avatar))
                                        <img class="rounded-circle header-profile-user"
                                             src="/storage/avatar/{{ $item->author->avatar }}" alt="Header Avatar">
                                    @else
                                        <img class="rounded-circle header-profile-user"
                                             src="{{ asset('assets/images/users/user-dummy-img.jpg') }}"
                                             alt="Header Avatar">
                                    @endif
                                    <div class="w-100">
                                        <p class="my-auto mx-0"><strong>{{ $item->author->full_name }}:</strong>
                                            <span>{{ $item->content }}</span>
                                        </p>
                                        <button class="d-inline-block btn js-reply"
                                                onclick="return confirm('Em chưa làm cái này!');"
                                                data-parent-id="{{ $item->id }}" data-post-id="{{ $data->id }}">
                                            Reply
                                        </button>
                                        <span>{{ $item->created_at }}</span>
                                        <div class="replyContainer"></div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="no-comment">No comments.</p>
                        @endif
                    </div>
                @else
                    <a href="{{route('account.login')}}" class="btn btn-light">Login to comment</a>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <x-client.related-post id="{{ $data->id }}"/>
        </div>
    </div>
    <x-slot name="script">
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script src="{{asset('js/comment.js')}}"></script>
    </x-slot>
</x-client.client-layout>
