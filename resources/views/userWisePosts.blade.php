@extends('layouts.app')
@section('title')
    userWisePostList
@endsection

@section('content')

    <div class="container">

        @include('partials.heading')

        <div class="bg-info text-white text-center p-2">
            <h3 class="my-3">
                LIST OF ALL THE POSTS OF <span class="text-white">{{ $user->name }}</span>
                <span class="badge badge-pill badge-primary"> {{ $user->posts->count() }} Posts</span>
            </h3>

            <h4>
                <a href="{{ route('showProfile', $user->id) }}" class="btn btn-warning">
                    Learn About {{ $user->name }}
                </a>
            </h4>
        </div>
        <div class="my-2 bg-warning p-2 form-inline">
            <i class="fas fa-search text-white mr-2"></i>
            <input type="text" id="myInput" onkeyup="myFunction()" class="form-control" placeholder="Search in title">
        </div>
        <ul class="list-group" id="myUL">
            @foreach ($posts as $key => $post)
                <li class="list-group-item">
                    <h3>
                        {{ $key + 1 }}.
                        <a href="{{ route('post.show', $post->slug) }}" class>
                            <i class="fa fa-book mr-1" aria-hidden="true"></i>{{ $post->title }}{{ $post->id }}
                        </a>
                    </h3>
                    <p>
                        Written by:
                        <a href="{{ route('userWisePosts', $post->user->id) }}">
                            <span class="badge badge-info">
                                {{ $post->user->name }}
                            </span>
                        </a>

                        {{-- {{ $tableOfContents->user->name }} --}}
                    </p>
                    <p>
                        Created at: {{ $post->created_at->format('M d,Y \a\t h:i a') }}
                    </p>
                    <p>
                        @auth
                            @if ($post->user_id == Auth::user()->id || Auth::user()->is_admin())
                                <a href="{{ route('post.edit', $post->id) }}"
                                    class="float-right mx-2 btn btn-sm btn-warning">Edit</a>

                                <a href="#" class="float-right mx-2 btn btn-sm btn-danger"
                                    onclick="handleDelete({{ $post->id }})"><i class="far fa-trash-alt mr-1"></i>Delete</a>
                            @endif
                        @endauth
                    </p>
                </li>
            @endforeach
        </ul>
    </div>


    <div class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger">DELETE POST</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-danger font-weight-bold">
                    <p class="text-center">
                        <i class="fas fa-eraser"></i>
                        DO YOU REALLY WANT TO DELETE THE POST?
                    </p>
                </div>
                <div class="modal-footer">
                    <form action="" method="post" id='deleteForm'>
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">YES, DELETE THE POST</button>
                    </form>
                    <button type="button" class="btn btn-success" data-dismiss="modal">No, Go Back</button>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('js')

    <script>
        function handleDelete(id) {
            var form = document.getElementById('deleteForm')

            form.action = '/post/' + id;
            $('.modal').modal('show');
        }
    </script>

@endpush
