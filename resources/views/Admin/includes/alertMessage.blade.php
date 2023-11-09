@if (session('error-msg'))
    <div class="alert alert-danger alert-dismissible fade show js-alert" role="alert">
        <span>{{ session('error-msg') }}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session('success-msg'))
    <div class="alert alert-success alert-dismissible fade show js-alert" role="alert">
        <span>{{ session('success-msg') }}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
