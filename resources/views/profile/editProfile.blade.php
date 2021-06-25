@extends('layouts.app')

@section('title')
    Profile
@endsection


@push('head-js')
    <script src="https://cdn.tiny.cloud/1/n7l7i6ml4kha9vfr7uc5sv7w1rpvsmhij6a6ml92try82kur/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>
@endpush

@section('content')
    <div class="container">
        @include('partials.heading')

        <div class="card border-success mb-3">

            <div class="card-header bg-primary text-white border-success">

                Edit Your Profile
            </div>
            <div class="card-body text-white">


                <form action="{{ route('updateProfile') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group bg-info p-2">
                        <label for="title">Name</label>
                        <input name="name" type="text" class="form-control" id=title" placeholder="Enter name"
                            value="{{ $user->name }}">

                    </div>

                    <div class="form-group bg-info p-2">
                        <label for="body">Write The Body of Your Profile Here:</label>
                        <textarea name="body" class="form-control" id="body" rows="3">{{ $user->body }}</textarea>
                    </div>

                    <div class="form-group bg-dark p-2">
                        <input type="submit" class="btn btn-success" value="Publish" />
                    </div>
                </form>

            </div>

        </div>
    </div>
@endsection


@push('js')
    <script src="{{ asset('js/tinymce.js') }}" defer></script>

@endpush
