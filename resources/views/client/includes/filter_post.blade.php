<p>
    <a class="btn btn-success" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false"
       aria-controls="collapseExample">
        <i class="mdi mdi-account-search"></i>
        Tìm kiếm
    </a>
</p>
@php
    $title = app('request')->input('title');
    $categoryId = app('request')->input('category_id');
    $authorId = app('request')->input('author_id');
    $show = '';
    if (isset($title) || isset($categoryId) || isset($authorId)) {
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
                <form method="GET" action="{{ route('index') }}">
                    <div class="row">
                        <div class="col-md-4">
                            <x-input name="title" label="Tiêu đề" value="{{ $title }}" />
                        </div>
                        <div class="col-md-4">
                            <x-admin.mst-select name="category_id" label="Thể loại" table="categories"
                                                displayColumn="cate_name" value="{{ $categoryId }}"/>
                        </div>
                        <div class="col-md-4">
                            <x-admin.mst-select name="author_id" label="Tác giả" table="users"
                                                displayColumn="full_name" value="{{ $authorId }}"/>
                        </div>
                        <div class="col-md-12 mt-3">
                            <button id="btn-search" class="btn btn-primary ml-3 my-sm-0" type="submit">Tìm</button>
                            <a href="{{ route('index') }}" class="btn btn-success ml-3 my-sm-0">Reset</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
