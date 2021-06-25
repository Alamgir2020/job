@extends('layouts.app')

@section('content')
    <div class="container">

        @include('partials.heading')
        <div class="bg-info text-capitalize text-white text-center p-2">
            <h4 class="my-3 text-white">
                Posts of
                <span class="text-dark">

                    {{ Auth::user()->name }}
                </span>

            </h4>
        </div>
        <div class="form-inline my-3 bg-warning p-2">
            <i class="fas fa-search text-white mr-2"></i>
            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for your own posts"
                class="form-control">
        </div>

        <ul class="list-group" id="myUL">

            @foreach ($posts as $key => $post)
                <li class="list-group-item my-2">
                    <h3>

                        {{ $key + 1 }}.

                        <a href="{{ route('post.show', $post->slug) }}">

                            {{ $post->title }}
                        </a>

                    </h3>
                    <p>
                        Categories:
                        @foreach ($post->categories as $category)
                        <a href="{{ route('categoryWisePostsList', $category->slug) }}" class="badge-info badge-pill mr-2">
                                {{ $category->name }}

                            </a>
                        @endforeach
                    </p>
                    <p>
                        Created at: {{ $post->created_at->format('M d,Y \a\t h:i a') }}
                    </p>

                    @if ($post->active === 0)

                        <p class="bg-warning">
                            Publication Status : Draft
                        </p>
                    @else
                        <p class="bg-success">
                            Publication Status : Published
                        </p>
                    @endif

                    <p>
                        <a href="{{ route('post.edit', $post->id) }}" class="btn btn-sm btn-success float-right mx-2"><i
                                class="fas fa-edit mr-2"></i>Edit</a>
                        {{-- <a href="{{ route('post.dest', $post->id) }}" class="btn btn-sm btn-danger float-right"><i class="fas fa-trash-alt mr-2"></i>Delete</a> --}}

                        <a href="#" class="float-right mx-2 btn btn-sm btn-danger"
                            onclick="handleDelete({{ $post->id }})"><i class="far fa-trash-alt mr-1"></i>Delete</a>
                        </>
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
