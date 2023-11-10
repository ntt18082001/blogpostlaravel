<x-admin.admin-layout title="Bình luận">
    <div class="d-flex">
        <p>
            <a class="btn btn-success" data-bs-toggle="collapse" href="#collapseExample" role="button"
               aria-expanded="false" aria-controls="collapseExample">
                <i class="mdi mdi-account-search"></i>
                Tìm kiếm
            </a>
        </p>
    </div>
    @php
        $content = app('request')->input('cont');
        $authorId = app('request')->input('author_id');
        $show = '';
        if (isset($content) || isset($authorId)) {
            $show = 'show';
        }
    @endphp
    <div class="collapse {{ $show }}" id="collapseExample">
        <div class="mb-4" id="Search">
            <div class="card mb-0">
                <div class="card-header">
                    <h4>Bộ lọc</h4>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('admin.post_comment.index') }}">
                        <div class="row">
                            <div class="col-md-4">
                                <x-input name="cont" label="Tiêu đề" value="{{ $content }}"/>
                            </div>
                            <div class="col-md-4">
                                <x-admin.mst-select name="author_id" label="Tác giả" table="users"
                                                    displayColumn="full_name" value="{{ $authorId }}"/>
                            </div>
                            <div class="col-md-12 mt-3">
                                <button id="btn-search" class="btn btn-primary ml-3 my-sm-0" type="submit">Tìm
                                </button>
                                <a href="{{ route('admin.post_comment.index') }}" class="btn btn-success ml-3 my-sm-0">Reset</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nội dung</th>
                <th scope="col">Tác giả</th>
                <th scope="col">Bài viết</th>
                <th scope="col">Ngày tạo</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($data as $item)
                @if (isset($item->post))
                    <tr>
                        <td class="fit">{{ $item->id }}</td>
                        <td>{{ $item->content }}</td>
                        <td class="fit"><h5><span
                                    class="badge badge-outline-secondary">{{ $item->author->full_name }}</span></h5>
                        </td>
                        <td>
                            <h5><span class="badge badge-outline-primary">{{ $item->post->title }}</span><a
                                    href="{{ route('client.post.detail', ['id' => $item->post->id]) }}" target="_blank">
                                    <i class="mdi mdi-checkbox-multiple-marked-outline"></i>
                                </a></h5>
                        </td>
                        <td class="fit">{{ $item->created_at }}</td>
                        <td class="fit">
                            <a href="{{ route('admin.post_comment.delete', ['id' => $item->id]) }}"
                               class="btn btn-outline-danger"
                               onclick="return confirm('Xác nhận xóa bình luận [{{ $item->content }}]?')">
                                <i class="mdi mdi-delete"></i>
                            </a>
                        </td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    </div>
    <div>
        {{ $data->links() }}
    </div>
</x-admin.admin-layout>
