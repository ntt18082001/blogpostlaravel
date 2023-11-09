<x-admin.admin-layout title="Thêm mới bài viết">
    <x-slot name="header">
        <!-- quill css -->
        <link href="{{ asset('assets/libs/quill/quill.core.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('assets/libs/quill/quill.bubble.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('assets/libs/quill/quill.snow.css') }}" rel="stylesheet" type="text/css"/>
    </x-slot>
    <form action="{{ route('admin.post.save') }}" method="post" enctype="multipart/form-data">
        @csrf
        <x-input name="title" placeholder="Tiêu đề" label="Tiêu đề" required/>
        <div class="form-group group-container mb-3 mt-3">
            <label class="control-label required">Ảnh bìa</label>
            <input name="cover_path" id="img_path" type="file" class="form-control fake-d-none" accept="image/*">
            <div class="position-relative">
                <input type="button" class="btn btn-choose-file w-100 h-100 position-absolute">
                <div class="selectedImages w-100 height-img-cover">
                    <img class="image-review"/>
                </div>
            </div>
            @error ('cover_path')
            <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
        <x-textarea name="summary" placeholder="Tóm tắt" label="Tóm tắt" required/>
        @php
            $_old_value = old('content');
            $_value = empty($_old_value) ? '' : $_old_value;
        @endphp
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0 required">Nội dung</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="snow-editor" id="editor" style="height: 300px;">{!! $_value !!}</div>
                <!-- end Snow-editor-->
                <input type="hidden" id="content" name="content" value="{{ $_value }}"/>
            </div><!-- end card-body -->
            @error ('content')
            <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div><!-- end card -->
        <div class="row">
            <div class="col-md-6">
                <x-admin.mst-select name="category_id" label="Thể loại" table="categories"
                                    displayColumn="cate_name" required/>
                <!-- Base Example -->
                <div class="form-check mt-3 mb-3">
                    <input class="form-check-input" name="status" value="0" type="checkbox" id="checkStatus">
                    <label class="form-check-label" for="checkStatus">
                        Publish
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>Lưu</button>
            <a href="{{ route('admin.post.index') }}" class="btn btn-secondary"><i class="fa fa-save"></i>Trở về</a>
        </div>
    </form>
    <x-slot name="script">
        <!-- ckeditor -->
        <script src="{{ asset('assets/libs/quill/quill.min.js') }}"></script>
        <script src="{{ asset('js/config_quilljs.js') }}"></script>
        <script src="{{ asset('js/preview_img.js') }}"></script>
    </x-slot>
</x-admin.admin-layout>
