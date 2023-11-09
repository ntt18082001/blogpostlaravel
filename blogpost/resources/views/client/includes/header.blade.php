<nav class="navbar navbar-expand-lg navbar-landing fixed-top bg-white" id="navbar">
    <div class="container">
        <a class="navbar-brand" href="{{ route('index') }}">
            Blog
        </a>
        <button class="navbar-toggler py-0 fs-20 text-body" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
            <i class="mdi mdi-menu"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto mt-2 mt-lg-0" id="navbar-example">
                <li class="nav-item">
                    <a class="nav-link fs-14 active" href="{{ route('index') }}">Home</a>
                </li>
                <li class="nav-item">
                    <div class="dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            Categories
                        </a>
                        <x-client.categories-component/>
                    </div>
                </li>
            </ul>
            <div class="dropdown ms-sm-3 header-item topbar-user bg-white">
                @php
                    $name = "";
                    $avatar = "";
                    $role = 0;
                    if(\Illuminate\Support\Facades\Auth::check()) {
                        $user = \Illuminate\Support\Facades\Auth::user();
                        $name = $user->full_name;
                        $avatar = $user->avatar;
                        $role = $user->role_id;
                    }
                @endphp
                @if (Auth::check())
                    <button type="button" class="btn shadow-none" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="d-flex align-items-center">
                                    @if (isset($avatar))
                                        <img class="rounded-circle header-profile-user"
                                             src="/storage/avatar/{{ $avatar }}" alt="Header Avatar">
                                    @else
                                        <img class="rounded-circle header-profile-user"
                                             src="{{ asset('assets/images/users/user-dummy-img.jpg') }}"
                                             alt="Header Avatar">
                                    @endif
                                    <span class="text-start ms-xl-2">
                                        <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">
                                            @if (isset($name))
                                                {{$name}}
                                            @endif
                                        </span>
                                    </span>
                                </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <h6 class="dropdown-header">Welcome
                            @if (isset($name))
                                {{ $name }}!
                            @endif
                        </h6>
                        @if ($role == 1)
                            <a class="dropdown-item" target="_blank" href="{{ route('admin.home.index') }}">
                                <i class="mdi mdi-key text-muted fs-16 align-middle me-1"></i><span>Admin</span>
                            </a>
                        @endif
                        <a class="dropdown-item" href="{{ route('profile.index') }}">
                            <i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i>
                            <span class="align-middle" data-key="t-logout">Profile</span>
                        </a>
                        <a class="dropdown-item" href="{{ route('account.logout') }}">
                            <i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span class="align-middle"
                                                                                                    data-key="t-logout">Logout</span>
                        </a>
                    </div>
                @else
                    <a href="{{ route('account.login') }}"
                       class="btn btn-link fw-medium text-decoration-none text-dark">Login</a>
                    <a href="{{ route('account.register') }}" class="btn btn-primary">Register</a>
                @endif
            </div>
        </div>
    </div>
</nav>
