<x-admin.admin-layout title="Sửa tài khoản [{{ $data->username }}]">
    <form action="{{ route('admin.user.save', ['id' => $data->id]) }}" method="post" autocomplete="off"
          enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <x-input name="full_name" type="text" placeholder="" label="Họ và tên" required
                         value="{{ $data->full_name }}"/>
                <x-input name="username" label="Tên đăng nhập" required readonly value="{{ $data->username }}"/>
                <x-input name="email" placeholder="Email" type="email" label="Email" required
                         value="{{ $data->email }}"/>
                <x-input name="phone_number" placeholder="Số điện thoại" label="Số điện thoại" required
                         value="{{ $data->phone_number }}"/>
                <x-admin.mst-select-role name="role_id" label="Vai trò" required value="{{ $data->role_id }}"/>
                <x-textarea name="address" placeholder="Địa chỉ" label="Địa chỉ" value="{{ $data->address }}" required/>
            </div>
            <div class="col-md-6">
                <div class="form-group group-container">
                    <label class="control-label required">Ảnh đại diện</label>
                    <input name="avatar" id="img_path" type="file" class="form-control fake-d-none" accept="image/*">
                    <div class="position-relative d-flex justify-content-center">
                        <input type="button" class="btn btn-choose-file w-100 h-100 position-absolute">
                        <div class="selectedImages">
                            @if (isset($data->avatar))
                                <img class="image-review" src="/storage/avatar/{{ $data->avatar }}"/>
                            @else
                                <img class="image-review"/>
                            @endif
                        </div>
                    </div>
                    @error('avatar')
                    <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <x-input name="birth_day" type="date" required label="Ngày sinh"
                         value="{{ date('Y-m-d', strtotime($data->birth_day)) }}"/>
                <div>
                    @php
                        $isMale = $data->gender == 0 ? 'checked' : '';
                        $isFemale = $data->gender == 1 ? 'checked' : '';
                    @endphp
                    <label for="gender" class="form-label required d-block mt-3">Giới tính</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="male" {{ $isMale }} name="gender" value="0">
                        <label class="form-check-label" for="male">Nam</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="female" {{ $isFemale }} name="gender"
                               value="1">
                        <label class="form-check-label" for="female">Nữ</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group mt-3">
            <button type="submit" class="btn btn-primary">Lưu</button>
            <a href="{{ route('admin.user.index')}}" class="btn btn-secondary">Trở về</a>
        </div>
    </form>
    <x-slot name="script">
        <script src="{{ asset('js/preview_img.js') }}"></script>
    </x-slot>
</x-admin.admin-layout>
