@extends('layouts.app')

@section('title')
    Edit Comment
@endsection

@push('head-js')
    <script src="https://cdn.tiny.cloud/1/n7l7i6ml4kha9vfr7uc5sv7w1rpvsmhij6a6ml92try82kur/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>
@endpush

@section('content')
    <div class="container">

        <div class="card bg-success my-2">
            <h5 class="card-header bg-primary">Edit YOUR COMMENT HERE</h5>
            <div class="card-body">
                <form action="{{ route('comment.update', $comment->id) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="body">Write Here:</label>
                        <textarea name="body" class="form-control" id="body" rows="3">{{ $comment->body }}</textarea>
                    </div>

                    <div class="form-group">

                        <input type="submit" value="Submit" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('js/tinymce.js') }}" defer></script>

@endpush
