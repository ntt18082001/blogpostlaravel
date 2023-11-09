<x-admin.admin-layout title="Thêm mới thể loại">
    <form action="{{ route('admin.category.save') }}" method="post" autocomplete="off">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <x-input name="cate_name" type="text" placeholder="" label="Tên thể loại" required/>
                <x-textarea name="description" placeholder="Mô tả" label="Mô tả" required/>
            </div>
        </div>
        <div class="form-group mt-3">
            <button type="submit" class="btn btn-primary">Lưu</button>
            <a href="{{ route('admin.category.index')}}" class="btn btn-secondary">Trở về</a>
        </div>
    </form>
</x-admin.admin-layout>
