<x-client.client-layout title="My Blogs">
    <a href="{{ route('profile.index') }}" class="btn btn-info mb-3">Back</a>
    <div class="row">
        <div class="col-12">
            <div class="row">
                @foreach($data as $item)
                    <div class="col-xxl-6">
                        <div class="card">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <a href="{{ route('client.post.detail', ['id' => $item->id]) }}">
                                        <img class="rounded-start img-fluid h-100 object-cover img-thumb"
                                             src="/storage/post/{{ $item->cover_path }}" alt="Card image">
                                    </a>
                                </div>
                                <div class="col-md-8">
                                    <div class="card-header">
                                        <a href="{{ route('client.post.detail', ['id' => $item->id]) }}">
                                            <h5 class="card-title mb-0">
                                                {{ $item->title }}
                                                @if($item->status)
                                                    <i class="mdi mdi-eye"></i>
                                                @else
                                                    <i class="mdi mdi-eye-off"></i>
                                                @endif
                                            </h5>
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text mb-2">{{ $item->summary }}</p>
                                        <p class="card-text text-author"><small class="text-muted">{{ $item->author->full_name }} | {{ $item->created_at }}</small></p>
                                        <a href="{{ route('profile.editpost', ['id' => $item->id]) }}" class="btn btn-sm btn-outline-dark btn-left">Edit</a>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end card -->
                    </div><!-- end col -->
                @endforeach
            </div><!-- end row -->
        </div><!-- end col -->
    </div><!-- end row -->
    <div>
        {{ $data->links() }}
    </div>
</x-client.client-layout>
