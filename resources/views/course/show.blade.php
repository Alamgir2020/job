@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="div my-2">
                <a href="{{ route('post.create') }}" class="btn btn-success "><i class="fa fa-plus-circle mr-1"
                        aria-hidden="true"></i>Create a post here</a>
                <a href="" class="btn btn-info "><i class="fas fa-search mr-1"></i>Search a post here</a>
            </div>
            <div class="col-md-12">
                <div class="card my-3">
                    <div class="card-header">
                        <h3 class="display-3">
                            {{ $post->title }}
                        </h3>
                        <p>
                            Written By:
                            <a href="{{ route('userWisePosts', $post->user->id) }}">
                                <span class="badge badge-info">
                                    {{ $post->user->name }}
                                </span>
                            </a>

                        </p>
                        <p>
                            Created At: {{ $post->created_at->format('M d,Y \a\t h:i a') }}
                        </p>
                        </p>
                        <p>
                            Categories & Keywords: @foreach ($post->categories as $category)
                                <a href="{{ route('categoryWisePostsList', $category->slug) }}">
                                    <span class="badge badge-warning">
                                        {{ $category->name }}
                                    </span>
                                </a>
                            @endforeach
                        </p>
                    </div>

                    <div class="card-body">
                        @if (json_decode($post->image) == 'default.png')

                        @else
                            @foreach (json_decode($post->image) as $key => $image)
                                <p>Image No.{{ $key + 1 }}</p><img src="{{ asset('storage/post/' . $image) }}"
                                    class="img-fluid" alt=""></p>
                                <p></p>

                            @endforeach

                        @endif

                        {!! $post->body !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
