@extends('layouts.app')
@section('title')
    Offered Courses
@endsection

@section('content')

    <div class="container">
        @include('partials.heading')
        <div>
            <h4 class="my-3">
                LIST OF ALREADY OFFERED COURSES
            </h4>
        </div>
        <div class="input-container my-3">
            <i class="fas fa-search"></i>
            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for tables of contents"
                class="input-field">
        </div>

        <ul class="list-group" id="myUL">

            @foreach ($offeredCourses as $offeredCourse)

                <li class="list-group-item">

                    <a href="{{ route('post.show', $offeredCourse->slug) }}"><i class="fa fa-tag mr-1"
                            aria-hidden="true"></i>{{ $offeredCourse->title }}</a>


                </li>
            @endforeach
        </ul>
    </div>
@endsection

@push('js')

    <script src="{{ asset('js/myApp.js') }}" defer></script>
@endpush
