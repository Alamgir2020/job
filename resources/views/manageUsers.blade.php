@extends('layouts.app')
@section('title')
    Search A Category
@endsection

@section('content')

    <div class="container">
        @include('partials.heading')
        <div class="bg-info text-center text-white text-capitalize p-2">
            <h4 class="my-3">
                Manage Users
            </h4>
        </div>
        <div class="input-container my-3 bg-warning p-2 form-inline">
            <i class="fas fa-search mr-2 text-white"></i>
            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for categories" class="form-control">
        </div>

        <ul class="list-group" id="myUL">

            @foreach ($users as $key => $user)

                <li class="list-group-item">

                    <h4>

                        {{ $key + 1 }}.

                        <a href="{{ route('userWisePosts', $user->id) }}"><i class="fa fa-tag mr-2"
                                aria-hidden="true"></i>{{ $user->name }}</a>


                        <a href="{{ route('userWisePosts', $user->id) }}" class="btn btn-primary btn-sm ">
                            Posts <span class="badge badge-light">{{ $user->posts_count }}</span>
                        </a>


                        <button class="btn btn-danger btn-sm" onclick="deleteFunction({{ $user->id }})">Delete
                            Me</button>

                        <form action="{{ route('deleteUser', $user->id) }}" id="deleteForm-{{ $user->id }}"
                            method="POST">
                            @csrf
                        </form>


                    </h4>

                </li>
            @endforeach
        </ul>
    </div>
@endsection

@push('js')

    <script>
        function deleteFunction(id) {
            var txt;
            var r = confirm("Do You Really Want to Delete This User ???");
            if (r == true) {
                // txt = "You pressed OK!";

                document.getElementById('deleteForm-' + id).submit();

            } else {
                // txt = "You pressed Cancel!";
            }
            //   document.getElementById("demo").innerHTML = txt;
        }
    </script>
@endpush
