<x-admin.admin-layout title="Edit post">
    <x-slot name="header">
        <!-- quill css -->
        <link href="{{ asset('assets/libs/quill/quill.core.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/libs/quill/quill.bubble.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/libs/quill/quill.snow.css') }}" rel="stylesheet" type="text/css" />
    </x-slot>
    <form action="{{ route('admin.post.save', ['id' => $data->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        <x-input name="title" placeholder="Title" label="Title" required value="{{$data->title}}" />
        <div class="form-group group-container mb-3 mt-3">
            <label class="control-label required">Cover Image</label>
            <input name="cover_path" id="img_path" type="file" class="form-control fake-d-none" accept="image/*">
            <div class="position-relative">
                <input type="button" class="btn btn-choose-file w-100 h-100 position-absolute" >
                <div class="selectedImages w-100 height-img-cover">
                    @if(isset($data->cover_path))
                        <img class="image-review" src="/storage/post/{{$data->cover_path}}" />
                    @else
                        <img class="image-review" />
                    @endif
                </div>
            </div>
            @error('cover_path')
            <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
        <x-textarea name="summary" placeholder="Summary" label="Summary" required value="{{$data->summary}}" />
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0 required">Content</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="snow-editor" id="editor" style="height: 300px;">{!!$data->content!!}</div> <!-- end Snow-editor-->
                <input type="hidden" id="content" name="content" />
            </div><!-- end card-body -->
            @error('content')
            <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div><!-- end card -->
        <div class="row">
            <div class="col-md-6">
                <x-admin.mst-select name="category_id" label="Category" table="categories"
                                    displayColumn="cate_name" required value="{{$data->category_id}}" />
                <!-- Base Example -->
                <div class="form-check mt-3 mb-3">
                    <input class="form-check-input" name="status" {{$data->status ? 'checked' : ''}} type="checkbox" id="checkStatus">
                    <label class="form-check-label" for="checkStatus">
                        Publish
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>Submit</button>
            <a href="{{route('admin.post.index')}}" class="btn btn-secondary"><i class="fa fa-save"></i>Back</a>
        </div>
    </form>
    <x-slot name="script">
        <!-- ckeditor -->
        <script src="{{ asset('assets/libs/quill/quill.min.js') }}"></script>
        <script src="{{ asset('js/config_quilljs.js') }}"></script>
        <script src="{{ asset('js/preview_img.js') }}"></script>
    </x-slot>
</x-admin.admin-layout>
