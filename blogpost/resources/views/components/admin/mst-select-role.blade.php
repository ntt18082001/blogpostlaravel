@php
    $_name = $attributes['name'];
    $_label = $attributes['label'];
    $_old_value = old($_name);
    $_value = $attributes['value'] ?? '';
    $_value = empty($_old_value) ? $_value : $_old_value;
    $_isrequired = isset($attributes['required']) ? "required" : '';
@endphp
<div class="form-group mt-3 ">
    <label for="{{ $_name }}" class="form-label {{$_isrequired}}">{{ $_label }}</label>
    <select id="{{ $_name }}" name="{{ $_name }}" {{$_isrequired}}
    class="form-select @error($_name) is-invalid @enderror">
        <option value="">-- Choose a value --</option>
        @foreach ($data as $item => $val)
            @if ($_value == $val->id)
                <option value="{{ $val->id }}" selected>{{ $val->role_name }}</option>
            @else
                <option value="{{ $val->id }}">{{ $val->role_name }}</option>
            @endif
        @endforeach
    </select>
    <span class="text-danger"></span>
    {{-- Thông báo lỗi xác thực dữ liệu --}}
    @error($_name)
    <span class="text-danger">
        {{ $message }}
    </span>
    @enderror
</div>
