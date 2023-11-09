<x-admin.admin-layout title="Dashboard Blogger">
    <div class="row">
        <div class="col-md-6">
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="fw-medium text-muted mb-0">Tài khoản</p>
                            <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="{{ $countUser }}">0</span> users</h2>
                            <p class="mb-0 text-muted"><span class="badge bg-light text-success mb-0">
                                                                <i class="ri-arrow-up-line align-middle"></i> 16.24 %
                                                            </span> vs. previous month</p>
                        </div>
                        <div>
                            <div class="avatar-sm flex-shrink-0">
                                                            <span class="avatar-title bg-primary rounded-circle fs-2">
                                                                <i data-feather="users"></i>
                                                            </span>
                            </div>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div> <!-- end card-->
        </div> <!-- end col-->
        <div class="col-md-6">
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="fw-medium text-muted mb-0">Thể loại</p>
                            <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="{{ $countCate }}">0</span> category</h2>
                            <p class="mb-0 text-muted"><span class="badge bg-light text-danger mb-0">
                                                                <i class="ri-arrow-down-line align-middle"></i> 3.96 %
                                                            </span> vs. previous month</p>
                        </div>
                        <div>
                            <div class="avatar-sm flex-shrink-0">
                                                            <span class="avatar-title bg-danger rounded-circle fs-2">
                                                                <i data-feather="type"></i>
                                                            </span>
                            </div>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div> <!-- end card-->
        </div> <!-- end col-->
        <div class="col-md-6">
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="fw-medium text-muted mb-0">Bài viết</p>
                            <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="{{ $countPost }}">0</span> posts</h2>
                            <p class="mb-0 text-muted"><span class="badge bg-light text-danger mb-0">
                                                                <i class="ri-arrow-down-line align-middle"></i> 50.5 %
                                                            </span> vs. previous month</p>
                        </div>
                        <div>
                            <div class="avatar-sm flex-shrink-0">
                                                            <span class="avatar-title bg-secondary rounded-circle fs-2">
                                                                <i data-feather="layout"></i>
                                                            </span>
                            </div>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div> <!-- end card-->
        </div> <!-- end col-->
        <div class="col-md-6">
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="fw-medium text-muted mb-0">Bình luận</p>
                            <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="{{ $countComment }}">0</span> comments</h2>
                            <p class="mb-0 text-muted"><span class="badge bg-light text-danger mb-0">
                                                                <i class="ri-arrow-down-line align-middle"></i> 16.83 %
                                                            </span> vs. previous month</p>
                        </div>
                        <div>
                            <div class="avatar-sm flex-shrink-0">
                                                            <span class="avatar-title bg-success rounded-circle fs-2">
                                                                <i data-feather="message-square"></i>
                                                            </span>
                            </div>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div> <!-- end row-->
</x-admin.admin-layout>
