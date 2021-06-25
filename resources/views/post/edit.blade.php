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

        <div class="card my-2">
            <h5 class="card-header bg-primary text-white">Edit YOUR POST HERE</h5>
            <div class="card-body bg-success">
                <form action="{{ route('post.update', $post->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group bg-info p-2">
                        <label for="title">Title</label>
                        <input name="title" type="text" class="form-control" id=title" placeholder="Enter title"
                            value="{{ $post->title }}">

                    </div>
                    <div class="form-group bg-info p-2">
                        <label for="categories">Categories & Keywords</label>
                        <input name="categories" type="text" class="form-control" id=categories"
                            placeholder="English, English Grammar, English Articles, a, an, the" value="@foreach ($post->categories as $category) {{ $category->name }}, @endforeach" >
                        <small id="emailHelp" class="form-text text-white">Please enter as many comma seperated keywords as
                            possible so that people can easily search for your creation.</small>
                    </div>


                    <div class="form-group bg-info p-2">
                        <label for="body">Write The Body of Your Content Here:</label>
                        <textarea name="body" class="form-control" id="body" rows="20">


                                {!! $post->body !!}



                            </textarea>
                    </div>

                    <div class="form-group bg-warning p-2">
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
