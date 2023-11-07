<x-client.client-layout title="Profile - {{$data->full_name}}">
    <div class="row mb-3">
        <div class="col-md-4">
            @if(isset($data->avatar))
                <img src="/storage/avatar/{{$data->avatar}}" class="rounded float-start border w-100" alt="...">
            @else
                <img src="{{ asset('assets/images/users/user-dummy-img.jpg') }}" class="rounded float-start border w-100" alt="...">
            @endif
        </div>
        <div class="col-md-8">
            <p><strong>Fullname: </strong> {{$data->full_name}}</p>
            <p><strong>Email: </strong> {{$data->email}}</p>
            <p><strong>Phone number: </strong> {{$data->phone_number}}</p>
            <p><strong>Day of birth: </strong> {{$data->birth_day}}</p>
            <p><strong>Gender: </strong> {{$data->gender ? 'Female' : 'Male'}}</p>
            <p><strong>Address: </strong> {{$data->address}}</p>
        </div>
    </div>
    <a href="{{ route('profile.create-post') }}" class="btn btn-primary mb-3 me-3">
        <i class="mdi mdi-account-plus"></i>
        Create post
    </a>
    <div class="row">
        <div class="col-md-6">
            <a href="{{route('profile.all_post')}}">
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
            </a>
        </div> <!-- end col-->
        <div class="col-md-6">
            <a href="{{route('profile.all_post_published')}}">
                <div class="card card-animate">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="fw-medium text-muted mb-0">Blogs published</p>
                                <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="{{$countPostPublished}}">{{$countPostPublished}}</span> posts</h2>
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
            </a>
        </div>
        <div class="col-md-6">
            <a href="{{route('profile.all_post_unpublish')}}">
                <div class="card card-animate">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="fw-medium text-muted mb-0">Blogs unpublish</p>
                                <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="{{$countPostUnpublish}}">{{$countPostUnpublish}}</span> posts</h2>
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
            </a>
        </div>
    </div>
</x-client.client-layout>
