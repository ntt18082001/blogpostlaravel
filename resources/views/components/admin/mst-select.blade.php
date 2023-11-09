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
    <select id="{{ $_name }}" name="{{ $_name }}"
            class="form-select @error($_name) is-invalid @enderror" {{$_isrequired}}>
        <option value="">-- Chọn một giá trị --</option>
        @foreach ($data as $item)
            @if ($_value == $item->id)
                <option value="{{ $item->id }}" selected>{{ $item->$displayColumn }}</option>
            @else
                <option value="{{ $item->id }}">{{ $item->$displayColumn }}</option>
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
