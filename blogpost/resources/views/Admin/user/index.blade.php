<x-admin.admin-layout title="Accounts">
    <div class="d-flex">
        <a href="{{ route('admin.user.create') }}" class="btn btn-primary mb-3 me-3">
            <i class="mdi mdi-account-plus"></i>
            Create account
        </a>
        <p>
            <a class="btn btn-success" data-bs-toggle="collapse" href="#collapseExample" role="button"
               aria-expanded="false" aria-controls="collapseExample">
                <i class="mdi mdi-account-search"></i>
                Search
            </a>
        </p>
    </div>
    @php
        $username = app('request')->input('username');
        $email = app('request')->input('email');
        $show = '';
        if (isset($username) || isset($email)) {
            $show = 'show';
        }
    @endphp
    <div class="collapse {{ $show }}" id="collapseExample">
        <div class="mb-4" id="Search">
            <div class="card mb-0">
                <div class="card-header">
                    <h4>Search form</h4>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('admin.user.index') }}">
                        <div class="row">
                            <div class="col-md-4">
                                <x-input name="username" label="Username" value={{ $username }} />
                            </div>
                            <div class="col-md-4">
                                <x-input name="email" label="Email" type="email" value={{ $email }}/>
                            </div>
                            <div class="col-md-12 mt-3">
                                <button id="btn-search" class="btn btn-primary ml-3 my-sm-0" type="submit">Search
                                </button>
                                <a href="{{ route('admin.user.index') }}" class="btn btn-success ml-3 my-sm-0">Reset</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Avatar</th>
                <th scope="col">Fullname</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($data as $item)
                <tr>
                    <td class="fit">{{ $item->id }}</td>
                    <td class="fit text-center">
                        @if (isset($item->avatar))
                            <img class="rounded-circle header-profile-user avatar-sm"
                                 src="/storage/avatar/{{ $item->avatar }}" alt="Header Avatar">
                        @else
                            <img class="rounded-circle header-profile-user"
                                 src="{{ asset('assets/images/users/user-dummy-img.jpg') }}" alt="Header Avatar">
                        @endif
                    </td>
                    <td>{{ $item->full_name }}</td>
                    <td>{{ $item->username }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->role->role_name }}</td>
                    <td class="fit">
                        <a href="{{ route('admin.user.edit', ['id' => $item->id]) }}" class="btn btn-outline-secondary">
                            <i class="mdi mdi-account-edit"></i>
                        </a>
                        <a href="{{ route('admin.user.delete', ['id' => $item->id]) }}" class="btn btn-outline-danger"
                           onclick="return confirm('Confirm delete account [{{ $item->username }}]?')">
                            <i class="mdi mdi-delete"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div>
        {{ $data->links() }}
    </div>
</x-admin.admin-layout>
