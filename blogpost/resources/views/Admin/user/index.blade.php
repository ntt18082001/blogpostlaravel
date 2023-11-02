<x-admin.admin-layout title="User list">
    <a href="{{ route('admin.user.create') }}" class="btn btn-primary mb-3">
        <i class="mdi mdi-account-plus"></i>
        Create account
    </a>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Fullname</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($data as $item)
                <tr>
                    <td class="fit">{{ $item->id }}</td>
                    <td>{{ $item->full_name }}</td>
                    <td>{{ $item->username }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->role->role_name }}</td>
                    <td class="fit">
                        <a href="#" class="btn btn-outline-secondary">
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
