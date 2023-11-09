<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box horizontal-logo">
                    <a href="#" class="logo logo-dark">
						<span class="logo-sm">
							<img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="22">
						</span>
                        <span class="logo-lg">
							<img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="17">
						</span>
                    </a>
                    <a href="#" class="logo logo-light">
						<span class="logo-sm">
							<img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="22">
						</span>
                        <span class="logo-lg">
							<img src="{{ asset('assets/images/logo-light.png') }}" alt="" height="17">
						</span>
                    </a>
                </div>
                <button type="button"
                        class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger shadow-none"
                        id="topnav-hamburger-icon">
					<span class="hamburger-icon">
						<span></span>
						<span></span>
						<span></span>
					</span>
                </button>
            </div>
            <div class="d-flex align-items-center">
                <div class="dropdown ms-sm-3 header-item topbar-user">
                    @php
                        $name = "";
                        $avatar = "";
                        if(\Illuminate\Support\Facades\Auth::check()) {
                            $user = \Illuminate\Support\Facades\Auth::user();
                            $name = $user->full_name;
                            $avatar = $user->avatar;
                        }
                    @endphp
                    <button type="button" class="btn shadow-none" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<span class="d-flex align-items-center">
                            @if (isset($avatar))
                                <img class="rounded-circle header-profile-user"
                                     src="/storage/avatar/{{ $avatar }}" alt="Header Avatar">
                            @else
                                <img class="rounded-circle header-profile-user"
                                     src="{{ asset('assets/images/users/user-dummy-img.jpg') }}" alt="Header Avatar">
                            @endif
							<span class="text-start ms-xl-2">
								<span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">
                                    @if (isset($name))
                                        {{ $name }}
                                    @endif
								</span>
							</span>
						</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <h6 class="dropdown-header">
                            Welcome
                            @if (isset($name))
                                {{ $name }}!
                            @endif
                        </h6>
                        <a class="dropdown-item" href="#">
                            <i class="mdi mdi-key text-muted fs-16 align-middle me-1"></i><span>Change password</span>
                        </a>
                        <a class="dropdown-item" href="{{ route('account.logout') }}">
                            <i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span class="align-middle"
                                                                                                    data-key="t-logout">Logout</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
