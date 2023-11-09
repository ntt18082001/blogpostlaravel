<x-client.client-layout title="Profile - {{ $data->full_name }}">
    <form action="{{ route('profile.save', ['id' => $data->id]) }}" method="post" class="mb-3" autocomplete="off" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <div class="form-group group-container">
                    <label class="control-label required">Avatar</label>
                    <input name="avatar" id="img_path" type="file" class="form-control fake-d-none"  accept="image/*">
                    <div class="position-relative d-flex justify-content-center">
                        <input type="button" class="btn btn-choose-file w-100 h-100 position-absolute" >
                        <div class="selectedImages w-100">
                            @if (isset($data->avatar))
                                <img class="image-review" src="/storage/avatar/{{ $data->avatar }}" />
                            @else
                                <img class="image-review" />
                            @endif
                        </div>
                    </div>
                    @error('avatar')
                    <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

            </div>
            <div class="col-md-8">
                <x-input name="full_name" type="text" placeholder="" label="Fullname" required value="{{ $data->full_name }}" />
                <x-input name="phone_number" placeholder="Phone number" label="Phone number" required  value="{{ $data->phone_number }}" />
                <x-textarea name="address" placeholder="Address" label="Address" value="{{ $data->address }}" />
                <x-input name="birth_day" type="date" required label="Day of birth"
                         value="{{ date('Y-m-d', strtotime($data->birth_day)) }}" />
                <div>
                    @php
                        $isMale = $data->gender == 0 ? 'checked' : '';
                        $isFemale = $data->gender == 1 ? 'checked' : '';
                    @endphp
                    <label for="gender" class="form-label required d-block mt-3">Gender</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="male" {{ $isMale }} name="gender" value="0">
                        <label class="form-check-label" for="male">Male</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="female" {{ $isFemale }} name="gender" value="1">
                        <label class="form-check-label" for="female">Female</label>
                    </div>
                </div>

                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-success">Update</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
            </div>
        </div>
    </form>
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
                                <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value"
                                                                                data-target="{{ $countPost }}">{{ $countPost }}</span>
                                    posts</h2>
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
    </div>
    <x-slot name="script">
        <script src="{{ asset('js/preview_img.js') }}"></script>
    </x-slot>
</x-client.client-layout>
