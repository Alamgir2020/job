@extends('layouts.app')
@section('title')
    All Tables of Contents
@endsection

@section('content')

    <div class="container">
        @include('partials.heading')
        <div class="bg-info text-center text-white p-2">
            <h4 class="my-3">
                LIST OF All The Tables of Contents
            </h4>
        </div>
        <div class="input-container my-3 bg-warning p-2 form-inline">
            <i class="fas fa-search mr-2 text-white"></i>
            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for tables of contents"
                class="form-control">
        </div>

        <ul class="list-group" id="myUL">

            @foreach ($allTablesOfContents as $key => $tableOfContents)

                <li class="list-group-item">

                    <h3>
                        {{ $key + 1 }}.
                        <a href="{{ route('post.show', $tableOfContents->slug) }}"><span
                                class="mr-2">&#9883;</span>{{ $tableOfContents->title }}</a>
                    </h3>
                    <p>
                        Written by:
                        <a href="{{ route('userWisePosts', $tableOfContents->user->id) }}">
                            <span class="badge badge-success">
                                {{ $tableOfContents->user->name }}
                            </span>
                        </a>

                    </p>
                    <p>
                        Categories:
                        @foreach ($tableOfContents->categories as $category)
                        <a href="{{ route('categoryWisePostsList', $category->slug) }}" class="badge-info badge-pill mr-2">
                                {{ $category->name }}

                            </a>
                        @endforeach
                    </p>
                    <p>
                        Created at: {{ $tableOfContents->created_at->format('M d,Y \a\t h:i a') }}
                    </p>

                    <p>
                        @auth
                            @if ($tableOfContents->user_id == Auth::user()->id || Auth::user()->is_admin())
                                <a href="{{ route('post.edit', $tableOfContents->id) }}"
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
