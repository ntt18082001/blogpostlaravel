<x-client.client-layout title="{{ $data->title }}">
    <div class="row">
        <div class="col-md-8">
            <p>Đăng bởi: {{ $data->author->full_name }} | Ngày đăng: {{ $data->created_at }}</p>
            <div class="content-blog">
                {!! $data->content !!}
            </div>
            <div class="mt-3">
                <h4>Bình luận</h4>
                @if (auth()->check())
                    <form class="mt-3 form-comment" method="post">
                        <input type="hidden" name="post_id" value="{{ $data->id }}">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" required name="content" placeholder="abc..."
                                   aria-label="Recipient's username" aria-describedby="button-addon2">
                            <button class="btn btn-outline-secondary js-submit" type="submit" id="button-addon2">
                                Gửi
                            </button>
                        </div>
                    </form>
                    <div class="mt-3 comment-container">
                        @if (count($comments) > 0)
                            @foreach ($comments as $item)
                                <div class="d-flex gap-2 mt-2">
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
                                                data-parent-id="{{ $item->id }}" data-post-id="{{ $data->id }}">
                                            Trả lời
                                        </button>
                                        <span>{{ $item->created_at }}</span>
                                        <div class="replyContainer"></div>
                                        <div class="replyCommentContainer{{$item->id}}{{$data->id}}">
                                            @if (count($item->comment_childs) > 0)
                                                @foreach ($item->comment_childs as $itemChild)
                                                    <div class="d-flex gap-2 mt-2">
                                                        @if (isset($itemChild->author->avatar))
                                                            <img class="rounded-circle header-profile-user"
                                                                 src="/storage/avatar/{{ $itemChild->author->avatar }}"
                                                                 alt="Header Avatar">
                                                        @else
                                                            <img class="rounded-circle header-profile-user"
                                                                 src="{{ asset('assets/images/users/user-dummy-img.jpg') }}"
                                                                 alt="Header Avatar">
                                                        @endif
                                                        <div class="w-100">
                                                            <p class="my-auto mx-0">
                                                                <strong>{{ $itemChild->author->full_name }}:</strong>
                                                                <span>{{ $itemChild->content }}</span>
                                                            </p>
                                                            <span>{{ $item->created_at }}</span>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        @if ($item->has_child)
                                            @php
                                                $lastEle = $item->comment_childs->last();
                                            @endphp
                                            <button class="btn btn-link js-load-more" data-last-comment-id="{{ $lastEle->id }}"
                                                    data-post-id="{{ $data->id }}"
                                                    data-parent-id="{{ $lastEle->parent_id }}">
                                                Xem thêm bình luận
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                            <div class="mt-3">
                                {{ $comments->links() }}
                            </div>
                        @else
                            <p class="no-comment">Chưa có bình luận nào.</p>
                        @endif
                    </div>
                @else
                    <a href="{{route('account.login')}}" class="btn btn-light">Đăng nhập để bình luận</a>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <x-client.related-post id="{{ $data->id }}"/>
        </div>
    </div>
    <x-slot name="script">
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script src="{{ asset('js/comment.js') }}"></script>
    </x-slot>
</x-client.client-layout>
