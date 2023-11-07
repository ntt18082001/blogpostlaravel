<x-client.client-layout title="Profile - {{$data->full_name}}">
    <a href="{{ route('profile.create-post') }}" class="btn btn-primary mb-3 me-3">
        <i class="mdi mdi-account-plus"></i>
        Create post
    </a>
    <div class="col-md-6">
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="fw-medium text-muted mb-0">My Blogs</p>
                        <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="{{$countPost}}">{{$countPost}}</span> posts</h2>
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
</x-client.client-layout>
