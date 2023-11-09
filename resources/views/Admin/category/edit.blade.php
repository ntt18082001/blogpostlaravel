<x-admin.admin-layout title="Cập nhật thể loại">
    <form action="{{ route('admin.category.save', ['id' => $data->id]) }}" method="post" autocomplete="off">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <x-input name="cate_name" type="text" placeholder="" label="Tên thể loại" required
                         value="{{ $data->cate_name }}"/>
                <x-textarea name="description" placeholder="Mô tả" label="Mô tả" required
                            value="{{ $data->description }}"/>
            </div>
        </div>
        <div class="form-group mt-3">
            <button type="submit" class="btn btn-primary">Lưu</button>
            <a href="{{ route('admin.category.index') }}" class="btn btn-secondary">Trở</a>
        </div>
    </form>
</x-admin.admin-layout>
