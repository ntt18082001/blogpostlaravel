<x-client.account-layout title="Register">
    <div class="card mt-4">
        <div class="card-body p-4">
            <div class="text-center mt-2">
                <h5 class="text-primary">Đăng ký</h5>
            </div>
            <div class="p-2 mt-4">
                <form method="post" action="{{ route('account.register_post') }}" autocomplete="off">
                    @csrf
                    @if (session('login-err-msg'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('login-err-msg') }}
                        </div>
                    @endif
                    <x-input name="full_name" label="Họ và tên" required/>
                    <x-input name="username" label="Tên đăng nhập" required/>
                    <x-input name="email" label="Email" type="email" required/>
                    <x-input name="phone_number" label="Số điện thoại" required/>
                    <div class="mb-3 mt-3">
                        <label class="form-label" for="password-input">Mật khẩu</label>
                        <div class="position-relative auth-pass-inputgroup mb-3">
                            <input name="password" type="password" required="required"
                                   class="form-control pe-5 password-input" id="password-input">
                            <button
                                class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                type="button" id="password-addon"><i
                                    class="ri-eye-fill align-middle"></i></button>
                        </div>
                        @error ('password')
                        <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="password-input">Xác nhận mật khẩu</label>
                        <div class="position-relative auth-pass-inputgroup mb-3">
                            <input name="confirmPassword" type="password" required="required"
                                   class="form-control pe-5 password-input" id="password-input">
                            <button
                                class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                type="button" id="password-addon"><i
                                    class="ri-eye-fill align-middle"></i></button>
                        </div>
                        @error ('confirmPassword')
                        <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="mt-4">
                        <button class="btn btn-success w-100" type="submit">Đăng ký</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- end card body -->
    </div>
    <!-- end card -->
    <div class="mt-4 text-center">
        <p class="mb-0">Bạn đã có tài khoản? <a href="{{ route('account.login') }}"
                                                 class="fw-semibold text-primary text-decoration-underline"> Đăng nhập </a>
        </p>
    </div>
</x-client.account-layout>
