<x-admin.admin-layout title="Edit category">
    <form action="{{ route('admin.category.save', ['id' => $data->id]) }}" method="post" autocomplete="off">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <x-input name="cate_name" type="text" placeholder="" label="Name" required value="{{ $data->cate_name }}" />
                <x-textarea name="description" placeholder="Description" label="Description" required value="{{ $data->description }}" />
            </div>
        </div>
        <div class="form-group mt-3">
            <button type="submit" class="btn btn-primary">Create</button>
            <a href="{{ route('admin.category.index')}}" class="btn btn-secondary">Back</a>
        </div>
    </form>
</x-admin.admin-layout>
