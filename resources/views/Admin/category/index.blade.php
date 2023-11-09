<x-admin.admin-layout title="Categories">
    <div class="d-flex">
        <a href="{{ route('admin.category.create') }}" class="btn btn-primary mb-3 me-3">
            <i class="mdi mdi-account-plus"></i>
            Thêm mới
        </a>
        <p>
            <a class="btn btn-success" data-bs-toggle="collapse" href="#collapseExample" role="button"
               aria-expanded="false" aria-controls="collapseExample">
                <i class="mdi mdi-account-search"></i>
                Tìm kiếm
            </a>
        </p>
    </div>
    @php
        $cateName = app('request')->input('cate_name');
        $show = isset($cateName) ? 'show' : '';
    @endphp
    <div class="collapse {{ $show }}" id="collapseExample">
        <div class="mb-4" id="Search">
            <div class="card mb-0">
                <div class="card-header">
                    <h4>Bộ lọc</h4>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('admin.category.index') }}">
                        <div class="row">
                            <div class="col-md-4">
                                <x-input name="cate_name" label="Tên thể loại" value="{{ $cateName }}" />
                            </div>
                            <div class="col-md-12 mt-3">
                                <button id="btn-search" class="btn btn-primary ml-3 my-sm-0" type="submit">Tìm kiếm
                                </button>
                                <a href="{{ route('admin.category.index') }}"
                                   class="btn btn-success ml-3 my-sm-0">Reset</a>
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
                <th scope="col">Tên thể loại</th>
                <th scope="col">Mô tả</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($data as $item)
                <tr>
                    <td class="fit">{{ $item->id }}</td>
                    <td>{{ $item->cate_name }}</td>
                    <td>{{ $item->description }}</td>
                    <td class="fit">
                        <a href="{{ route('admin.category.edit', ['id' => $item->id]) }}"
                           class="btn btn-outline-secondary">
                            <i class="mdi mdi-account-edit"></i>
                        </a>
                        <a href="{{ route('admin.category.delete', ['id' => $item->id]) }}"
                           class="btn btn-outline-danger"
                           onclick="return confirm('Xác nhận xóa thể loại [{{ $item->description }}]?')">
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
