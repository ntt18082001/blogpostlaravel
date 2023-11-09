<x-admin.admin-layout title="Posts">
    <div class="d-flex">
        <a href="{{ route('admin.post.create') }}" class="btn btn-primary mb-3 me-3">
            <i class="mdi mdi-account-plus"></i>
            Create post
        </a>
        <p>
            <a class="btn btn-success" data-bs-toggle="collapse" href="#collapseExample" role="button"
               aria-expanded="false" aria-controls="collapseExample">
                <i class="mdi mdi-account-search"></i>
                Search
            </a>
        </p>
    </div>
    @php
        $title = app('request')->input('title');
        $status = app('request')->input('status');
        $categoryId = app('request')->input('category_id');
        $authorId = app('request')->input('author_id');
        $checked = isset($status) ? 'checked' : '';
        $show = '';
        if (isset($title) || isset($status) || isset($categoryId) || isset($authorId)) {
            $show = 'show';
        }
    @endphp
    <div class="collapse {{ $show }}" id="collapseExample">
        <div class="mb-4" id="Search">
            <div class="card mb-0">
                <div class="card-header">
                    <h4>Search form</h4>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('admin.post.index') }}">
                        <div class="row">
                            <div class="col-md-4">
                                <x-input name="title" label="Title" value={{ $title }} />
                            </div>
                            <div class="col-md-4">
                                <x-admin.mst-select name="category_id" label="Category" table="categories"
                                                    displayColumn="cate_name" value="{{ $categoryId }}"/>
                            </div>
                            <div class="col-md-4">
                                <x-admin.mst-select name="author_id" label="Author" table="users"
                                                    displayColumn="full_name" value="{{ $authorId }}"/>
                            </div>
                            <div class="col-md-4">
                                <!-- Base Example -->
                                <div class="form-check mt-3">
                                    <input class="form-check-input" name="status" type="checkbox"
                                           {{ $checked }} id="checkStatus">
                                    <label class="form-check-label" for="checkStatus">
                                        Published
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <button id="btn-search" class="btn btn-primary ml-3 my-sm-0" type="submit">Search
                                </button>
                                <a href="{{ route('admin.post.index') }}" class="btn btn-success ml-3 my-sm-0">Reset</a>
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
                <th scope="col">Cover Image</th>
                <th scope="col">Title</th>
                <th scope="col">Category</th>
                <th scope="col">Author</th>
                <th scope="col">Status</th>
                <th scope="col">Created At</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($data as $item)
                <tr>
                    <td class="fit">{{ $item->id }}</td>
                    <td class="fit text-center">
                        <img class="rounded shadow" alt="200x200" width="200"
                             src="/storage/post/{{ $item->cover_path }}">
                    </td>
                    <td>
                        {{ $item->title }}
                    </td>
                    <td><h5><span class="badge badge-outline-primary">{{ $item->category->cate_name }}</span></h5></td>
                    <td><h5><span class="badge badge-outline-secondary">{{ $item->author->full_name }}</span></h5></td>
                    <td>
                        @if ($item->status)
                            <h5><span class="badge badge-outline-dark me-2">Published</span></h5>
                        @else
                            <h5><span class="badge badge-outline-dark me-2">Un publish</span></h5>
                        @endif
                    </td>
                    <td>{{ $item->created_at }}</td>
                    <td class="fit">
                        <a href="{{ route('client.post.detail', ['id' => $item->id]) }}" target="_blank"
                           class="btn btn-outline-dark">
                            <i class="mdi mdi-eye"></i>
                        </a>
                        <a href="{{ route('admin.post.edit', ['id' => $item->id]) }}" class="btn btn-outline-secondary">
                            <i class="mdi mdi-account-edit"></i>
                        </a>
                        <a href="{{ route('admin.post.delete', ['id' => $item->id]) }}" class="btn btn-outline-danger"
                           onclick="return confirm('Confirm delete post [{{ $item->title }}]?')">
                            <i class="mdi mdi-delete"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div>
        {{ $data->links() }}
    </div>
</x-admin.admin-layout>
