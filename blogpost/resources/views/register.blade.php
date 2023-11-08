<x-client.account-layout title="Register">
    <div class="card mt-4">
        <div class="card-body p-4">
            <div class="text-center mt-2">
                <h5 class="text-primary">Welcome</h5>
                <p class="text-muted">Register</p>
            </div>
            <div class="p-2 mt-4">
                <form method="post" action="{{ route('account.register_post') }}" autocomplete="off">
                    @csrf
                    @if (session('login-err-msg'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('login-err-msg') }}
                        </div>
                    @endif
                    <x-input name="full_name" label="Fullname" />
                    <x-input name="username" label="Username"/>
                    <x-input name="email" label="Email" type="email" />
                    <x-input name="phone_number" label="Phone number" />
                    <div class="mb-3 mt-3">
                        <label class="form-label" for="password-input">Password</label>
                        <div class="position-relative auth-pass-inputgroup mb-3">
                            <input name="password" type="password" required="required"
                                   class="form-control pe-5 password-input" id="password-input">
                            <button
                                class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                type="button" id="password-addon"><i
                                    class="ri-eye-fill align-middle"></i></button>
                        </div>
                        @error('password')
                        <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="password-input">Confirm password</label>
                        <div class="position-relative auth-pass-inputgroup mb-3">
                            <input name="confirmPassword" type="password" required="required"
                                   class="form-control pe-5 password-input" id="password-input">
                            <button
                                class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                type="button" id="password-addon"><i
                                    class="ri-eye-fill align-middle"></i></button>
                        </div>
                        @error('confirmPassword')
                        <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="mt-4">
                        <button class="btn btn-success w-100" type="submit">Register</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- end card body -->
    </div>
    <!-- end card -->
    <div class="mt-4 text-center">
        <p class="mb-0">You have an account ? <a href="{{route('account.login')}}" class="fw-semibold text-primary text-decoration-underline"> Login </a> </p>
    </div>
</x-client.account-layout>
