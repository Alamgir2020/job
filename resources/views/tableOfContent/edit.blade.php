@extends('layouts.app')

@section('title')
    Edit Post
@endsection

@push('head-js')
    <script src="https://cdn.tiny.cloud/1/n7l7i6ml4kha9vfr7uc5sv7w1rpvsmhij6a6ml92try82kur/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>
@endpush

@section('content')
    <div class="container">

        <div class="card">
            <h5 class="card-header">Edit YOUR POST HERE</h5>
            <div class="card-body">
                <form action="{{ route('post.update', $post->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input name="title" type="text" class="form-control" id=title" placeholder="Enter title"
                            value="{{ $post->title }}">

                    </div>
                    <div class="form-group">
                        <label for="categories">Categories & Keywords</label>
                        <input name="categories" type="text" class="form-control" id=categories"
                            placeholder="English, English Grammar, English Articles, a, an, the" value="@foreach ($post->categories as $category) {{ $category->name }}, @endforeach" >
                        <small id="emailHelp" class="form-text text-muted">Please enter as many comma seperated keywords as
                            possible so that people can easily search for your creation.</small>
                    </div>
                    <div class="form-group">
                        <label for="images">Upload multiple images here(optional).</label>
                        <input name="images[]" type="file" class="form-control-file" id="images" accept="image/*" multiple>
                    </div>


                    <div class="form-group">
                        <label for="body">Write Thee Body of Your Content Here:</label>
                        <textarea name="body" class="form-control" id="body" rows="3">{{ $post->body }}</textarea>
                    </div>

                    <div class="form-group">
                        <input type="submit" name='publish' class="btn btn-success" value="Publish" />
                        <input type="submit" name='save' class="btn btn-primary" value="Save Draft" />
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('js/tinymce.js') }}" defer></script>

@endpush
