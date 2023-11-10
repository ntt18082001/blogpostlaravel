<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Light Logo-->
        <a href="{{ route('index') }}" target="_blank" class="logo">
            <h4 class="logo-sm text-black mt-4">
                <span>
                    Blog Post
                </span>
            </h4>
            <h4 class="logo-lg text-black mt-4">
                <span>
                    Blog Post
                </span>
            </h4>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
                id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>
    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.home.index') }}">
                        <i class="mdi mdi-open-in-new"></i> <span data-key="t-widgets">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.user.index') }}">
                        <i class="mdi mdi-account"></i> <span data-key="t-widgets">Tài khoản</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.category.index') }}">
                        <i class="mdi mdi-format-list-bulleted"></i> <span data-key="t-widgets">Thể loại</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.post.index') }}">
                        <i class="mdi mdi-newspaper"></i> <span data-key="t-widgets">Bài viết</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.post_comment.index') }}">
                        <i class="mdi mdi-comment"></i> <span data-key="t-widgets">Bình luận</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
