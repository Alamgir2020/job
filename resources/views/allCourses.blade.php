@extends('layouts.app')
@section('title')
    Offered Courses
@endsection

@section('content')

    <div class="container">
        @include('partials.heading')
        <div class="bg-info text-center text-capitalize text-white p-2">
            <h4 class="my-3">
                List of offered courses
            </h4>
        </div>
        <div class="input-container my-3 bg-warning p-2 form-inline">
            <i class="fas fa-search text-white mr-2"></i>
            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search in title" class="form-control">
        </div>

        <ul class="list-group" id="myUL">

            @foreach ($offeredCourses as $key => $offeredCourse)

                <li class="list-group-item">
                    <h3>
                        {{ $key + 1 }}.

                        <a href="{{ route('post.show', $offeredCourse->slug) }}"><span
                                class="mr-2">&#9883;</span>{{ $offeredCourse->title }}</a>
                    </h3>

                    <p>
                        Written by:
                        <a href="{{ route('userWisePosts', $offeredCourse->user->id) }}">
                            <span class="badge badge-success">
                                {{ $offeredCourse->user->name }}

                            </span>
                        </a>

                    </p>
                    <p>
                        Categories:
                        @foreach ($offeredCourse->categories as $category)
                        <a href="{{ route('categoryWisePostsList', $category->slug) }}" class="badge-info badge-pill mr-2">
                                {{ $category->name }}

                            </a>
                        @endforeach
                    </p>
                    <p>
                        Created at: {{ $offeredCourse->created_at->format('M d,Y \a\t h:i a') }}
                    </p>


                    <p>
                        @auth
                            @if ($offeredCourse->user_id == Auth::user()->id || Auth::user()->is_admin())
                                <a href="{{ route('post.edit', $offeredCourse->id) }}"
                                    class="float-right mx-2 btn btn-sm btn-warning">Edit</a>
                                <a href="" class="float-right mx-2 btn btn-sm btn-danger">Delete</a>
                            @endif
                        @endauth
                    </p>



                </li>
            @endforeach
        </ul>
    </div>
@endsection

@push('js')

    <script src="{{ asset('js/myApp.js') }}" defer></script>
@endpush
