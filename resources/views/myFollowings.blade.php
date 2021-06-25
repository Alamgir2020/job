@extends('layouts.app')
@section('title')
    My Followings
@endsection

@section('content')

    <div class="container">
        @include('partials.heading')
        <div class="bg-info text-center text-white text-capitalize p-2">
            <h4 class="my-3">
                My Followings
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

                        <a href="{{ route('userWisePosts', $user->id) }}">{{ $user->name }}</a>
                        <a href="{{ route('userWisePosts', $user->id) }}" class="btn btn-primary btn-sm float-right">
                            Posts <span class="badge badge-light">{{ $user->posts_count }}</span>
                        </a>
                    </h4>

                </li>
            @endforeach
        </ul>
    </div>
@endsection

@push('js')

    <script src="{{ asset('js/myApp.js') }}" defer></script>
@endpush
