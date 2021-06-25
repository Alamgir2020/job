@extends('layouts.app')
@section('title')
    Welcome
@endsection

@section('content')

    <div class="container">
        @include('partials.heading')

        <div class="bg-success p-3 text-center my-2">
            <h4 class="my-3 text-white">
                To create a post click on

                <a href="{{ route('post.create') }}" class="btn btn-light m-2"><i class="fa fa-plus-circle"
                        aria-hidden="true"></i><i class="fas fa-book-open mx-2"></i>Create A Post</a>.
                To create a list of the links of a particular subject click on

                <a href="{{ route('table-of-contents.create') }}" class="btn btn-light  m-2"><i
                        class="fa fa-plus-circle mr-1" aria-hidden="true"></i><i class="fas fa-table mx-2"></i>Create A
                    Table Of
                    Contents</a>.

                If you want to teach either for a payment or for free click

                <a href="{{ route('courses.create') }}" class="m-2 btn btn-light "><i class="fa fa-plus-circle mr-1"
                        aria-hidden="true"></i><i class="fas fa-user-graduate mx-2"></i>Offer A Course</a>.
            </h4>
        </div>

        <div class="bg-info p-1 text-center">
            <h4 class="my-3 text-white">
                List Of Categories And Keywords
            </h4>
        </div>
        <div class="input-container my-3 bg-warning p-2 form-inline">
            <i class="fas fa-search text-white mr-1"></i>
            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search here" class="form-control">
        </div>

        <ul class="list-group" id="myUL">

            @foreach ($categories as $key => $category)

                <li class="list-group-item">

                    <h4>

                        {{ $key + 1 }}.
                        <a href="{{ route('categoryWisePostsList', $category->slug) }}"><i class="fa fa-tag mr-1"
                                aria-hidden="true"></i>{{ $category->name }}</a>
                        <a href="{{ route('categoryWisePostsList', $category->slug) }}" {{-- class="btn btn-primary btn-sm float-right"> --}}
                            class="badge badge-primary badge-pill">
                            Posts <span class="badge badge-pill badge-light">{{ $category->posts_count }}</span>
                        </a>
                    </h4>

                </li>
            @endforeach
        </ul>
    </div>
@endsection
