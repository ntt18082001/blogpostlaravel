<x-client.account-layout title="Login">
    <div class="card mt-4">
        <div class="card-body p-4">
            <div class="text-center mt-2">
                <h5 class="text-primary">Đăng nhập</h5>
            </div>
            <div class="p-2 mt-4">
                <form method="post" action="{{ route('account.auth') }}">
                    @csrf
                    @if (session('login-err-msg'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('login-err-msg') }}
                        </div>
                    @endif
                    <div class="mb-3">
                        <label for="username" class="form-label">Tên đăng nhập</label>
                        <input name="username" type="text" class="form-control" id="username" required="required"
                               placeholder="Tên đăng nhập....">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="password-input">Mật khẩu</label>
                        <div class="position-relative auth-pass-inputgroup mb-3">
                            <input name="password" type="password" required="required"
                                   class="form-control pe-5 password-input"
                                   placeholder="Mật khẩu..." id="password-input">
                            <button
                                class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                type="button" id="password-addon"><i
                                    class="ri-eye-fill align-middle"></i></button>
                        </div>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" checked
                               id="auth-remember-check">
                        <label class="form-check-label" for="auth-remember-check">Nhớ mật khẩu</label>
                    </div>
                    <div class="mt-4">
                        <button class="btn btn-success w-100" type="submit">Đăng nhập</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- end card body -->
    </div>
    <!-- end card -->
    <div class="mt-4 text-center">
        <p class="mb-0">Bạn chưa có tài khoản? <a href="{{ route('account.register') }}"
                                                  class="fw-semibold text-primary text-decoration-underline">Đăng ký ngay</a>
        </p>
    </div>
</x-client.account-layout>
