@extends('layouts.app')
@section('title')
    Search A Category
@endsection

@section('content')

    <div class="container">
        @include('partials.heading')
        <div class="bg-info text-center text-white text-capitalize p-2">
            <h4 class="my-3">
                List of categories or keywords
            </h4>
        </div>
        <div class="input-container my-3 bg-warning p-2 form-inline">
            <i class="fas fa-search mr-2 text-white"></i>
            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for categories" class="form-control">
        </div>

        <ul class="list-group" id="myUL">

            @foreach ($categories as $key => $category)

                <li class="list-group-item">

                    <h4>

                        {{ $key + 1 }}.

                        <a href="{{ route('categoryWisePostsList', $category->slug) }}"><i class="fa fa-tag mr-2"
                                aria-hidden="true"></i>{{ $category->name }}</a>
                        <a href="{{ route('categoryWisePostsList', $category->slug) }}"
                            class="btn btn-primary btn-sm float-right">
                            Posts <span class="badge badge-light">{{ $category->posts_count }}</span>
                        </a>
                        @if (Auth::user()->role === 'admin')
                            <button class="btn btn-danger btn-sm"
                                onclick="deletecategoryFunction({{ $category->id }})">Delete Me</button>

                            <form action="{{ route('deleteCategory', $category->id) }}"
                                id="deleteForm-{{ $category->id }}" method="POST">
                                @csrf
                            </form>
                        @endif
                    </h4>

                </li>
            @endforeach
        </ul>
    </div>
@endsection

@push('js')

    <script>
        function deletecategoryFunction(id) {
            var txt;
            var r = confirm("Do You Really Want to Delete This Category ???");
            if (r == true) {
                // txt = "You pressed OK!";

                document.getElementById('deleteForm-' + id).submit();

            } else {
                // txt = "You pressed Cancel!";
            }
            //   document.getElementById("demo").innerHTML = txt;
        }
    </script>


    {{-- <script src="{{ asset('js/myApp.js') }}" defer></script> --}}
@endpush
