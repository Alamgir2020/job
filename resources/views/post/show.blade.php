@extends('layouts.app')

@section('title')
    Read Post
@endsection

@push('head-js')
    <script src="https://cdn.tiny.cloud/1/n7l7i6ml4kha9vfr7uc5sv7w1rpvsmhij6a6ml92try82kur/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>
@endpush


@section('content')
    <div class="container">
        @include('partials.heading')
        <div class="row justify-content-center">

            <div class="col-md-12">
                <div class="card my-3">
                    <div class="card-header bg-primary text-white">
                        <h3 class="display-3">
                            {{ $post->title }}
                        </h3>
                        <p>
                            Written By:



                            <a href="{{ route('userWisePosts', $post->user->id) }}">
                                <span class="badge badge-warning">
                                    {{ $post->user->name }}
                                </span>
                            </a>


                            @if (Auth::id() === $post->user->id)
                                show nothing
                            @else
                                {{-- <a href=""
                                    class="btn btn-warning followBtn">Follow
                                    User</a> --}}
                                @if (Auth::user()->followings()->where('leader_id', $post->user->id)->count() > 0)
                                    <button class="btn btn-warning btn-sm followBtn ml-2"> <i
                                            class="fas fa-star mr-2"></i>Followed</button>

                                @else
                                    <button class="btn btn-warning followBtn ml-2"> <i
                                            class="far fa-star mr-2"></i>Follow</button>

                                @endif

                            @endif


                        </p>
                        <p>
                            {{-- Created At: {{ $post->created_at->diffforhumans() }} --}}
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
                        <div class="text-center bg-warning">
                            <h5 class="text-capitalize text-dark">share and help others learn</h5>
                            <!-- Go to www.addthis.com/dashboard to customize your tools -->
                            <div class="addthis_inline_share_toolbox"></div>
                        </div>
                    </div>

                    <div class="card-body ">


                        <div>

                            {!! $post->body !!}
                        </div>


                        <div class="text-capitalize bg-danger text-white p-3">
                            the post ends here
                        </div>
                    </div>

                    @guest
                        <div>

                            <i class="fas fa-thumbs-up"></i>

                            {{ $post->likingUsers->count() }} people like this
                        </div>

                    @endguest


                    @auth

                        <div class="bg-warning mt-1 mb-0 p-3 text-center ">

                            <span>

                                <i class="fas fa-thumbs-up"></i>
                                <span id="likingUsers">
                                    {{ $post->likingUsers->count() }} people liked this
                                </span>
                            </span>

                            @if (Auth::user()->likedPosts()->where('post_id', $post->id)->count() > 0)

                                <button class="likeBtn btn btn-primary btn-sm ml-2"> <i
                                        class="fas fa-thumbs-up mr-2"></i>Liked</button>
                            @else
                                <button class="likeBtn btn btn-primary btn-sm ml-2"><i class="far fa-thumbs-up mr-2"></i>Like
                                    This Post</button>

                            @endif

                            @if (Auth::user()->favorite_posts()->where('post_id', $post->id)->count() > 0)

                                <button class="favoriteBtn btn btn-primary btn-sm ml-2 my-2"><i
                                        class="fas fa-heart mr-2"></i>Added To Favorite</button>
                            @else
                                <button class="favoriteBtn btn btn-primary btn-sm ml-2 my-2"><i
                                        class="far fa-heart mr-2"></i>Add To Favorite</button>

                            @endif

                            @if (Auth::user()->reportedposts()->where('post_id', $post->id)->count() > 0)

                                <button
                                    onclick="event.preventDefault();
                                                                                                                                        document.getElementById('unReport-form').submit();"
                                    class="btn btn-success btn-sm ml-2"> <i class="fas fa-exclamation-circle mr-2"></i>Undo
                                    Report</button>

                                <form id="unReport-form" action="{{ route('reportPost', $post->id) }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                            @else
                                <button onclick="handleReport({{ $post->id }})" class="btn btn-danger btn-sm ml-2">
                                    <i class="fas fa-exclamation mr-2"></i>Report</button>

                            @endif

                        </div>



                    @endauth

                    <div class="text-center bg-warning">
                        <h5 class="text-capitalize text-dark">share and help others learn</h5>
                        <!-- Go to www.addthis.com/dashboard to customize your tools -->
                        <div class="addthis_inline_share_toolbox"></div>
                    </div>
                </div>


                <div class="mt-5 p-3 text-capitalize bg-info">
                    <h3>Please contribute to the post with constructive discussion and criticism</h3>
                </div>
                @if (Auth::guest())
                    <p>Login to contribute</p>
                @else
                    <div class="panel-body bg-warning">

                        <form action="{{ route('comment.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <textarea name="body"></textarea>
                            <button type="submit" class="btn btn-success my-2 ml-2">Save and Post</button>
                        </form>

                    </div>
                @endif
                <div>
                    @if ($comments)
                        <ul style="list-style: none; padding: 0">
                            @foreach ($comments as $comment)
                                <li class="panel-body my-2">
                                    <div class="list-group">
                                        <div class="list-group-item bg-info">
                                            <h3>{{ $comment->user->name }}</h3>
                                            <p>{{ $comment->created_at->format('M d,Y \a\t h:i a') }}</p>
                                        </div>
                                        <div class="list-group-item">
                                            <p>{!! $comment->body !!}</p>
                                        </div>
                                        @if ($comment->user_id === Auth::id() || Auth::user()->role === 'admin')
                                            <div class="list-group-item bg-warning">
                                                <a href="{{ route('comment.edit', $comment->id) }}"
                                                    class="btn btn-primary btn-sm mr-2"> <i
                                                        class="fas fa-edit mr-2"></i>Edit</a>
                                                <a href="#" onclick="deleteCommentFunction({{ $comment->id }})"
                                                    class="btn btn-danger btn-sm"><i
                                                        class="fas fa-trash-alt mr-2"></i>Delete</a>

                                                <form id="delete-comment-form-{{ $comment->id }}"
                                                    action="{{ route('comment.destroy', $comment->id) }}" method="POST"
                                                    class="d-none">
                                                    @csrf
                                                    @method('delete')
                                                </form>


                                            </div>
                                        @endif

                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>


                <div id="disqus_thread"></div>
                <script>
                    /**
                     *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                     *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
                    /*
                    var disqus_config = function () {
                    this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
                    this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                    };
                    */
                    (function() { // DON'T EDIT BELOW THIS LINE
                        var d = document,
                            s = d.createElement('script');
                        s.src = 'https://tsc-third.disqus.com/embed.js';
                        s.setAttribute('data-timestamp', +new Date());
                        (d.head || d.body).appendChild(s);
                    })();
                </script>
                <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered
                        by Disqus.</a></noscript>


            </div>
        </div>
    </div>








    <div class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger">Report POST</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-danger font-weight-bold">
                    <p class="text-center">
                        <i class="fas fa-eraser"></i>
                        DO YOU REALLY WANT TO REPORT AGAINST THE POST?
                    </p>
                </div>
                <div class="modal-footer">
                    <form action="" method="post" id='reportForm'>
                        @csrf

                        <button type="submit" class="btn btn-danger">YES, REPORT AGAINST THE POST</button>
                    </form>
                    <button type="button" class="btn btn-success" data-dismiss="modal">No, Go Back</button>
                </div>
            </div>
        </div>
    </div>


@endsection


@push('js')


    <script src="{{ asset('js/tinymce.js') }}" defer></script>

    <!-- Go to www.addthis.com/dashboard to customize your tools -->
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-605a339da9617550"></script>



    <script type="text/javascript">
        $('.likeBtn').on('click', function() {

            $.ajax({
                type: "POST",
                url: '{{ URL::to('/like-post/') . '/' . $post->id }}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    // "id": id
                },
                success: function(data) {
                    if (data) {

                        $('.likeBtn').html(data.success);
                        $('#likingUsers').html(data.users);

                    } else {
                        console.log('error');
                    }
                }
            });
        });


        $('.favoriteBtn').on('click', function() {


            $.ajax({
                type: "POST",
                url: '{{ URL::to('/favorite-post/') . '/' . $post->id }}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    // "id": id
                },
                success: function(data) {
                    if (data) {
                        //apply your condition

                        $('.favoriteBtn').html(data);

                    } else {
                        console.log('error');
                    }
                }
            });
        });

        $('.followBtn').on('click', function() {


            $.ajax({
                type: "POST",
                url: '{{ URL::to('/follow/') . '/' . $post->user->id }}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    // "id": id
                },
                success: function(data) {
                    if (data) {
                        //apply your condition

                        $('.followBtn').html(data);

                    } else {
                        console.log('error');
                    }
                }
            });
        });
    </script>

    <script>
        function handleReport(id) {
            var form = document.getElementById('reportForm')

            form.action = '/report-post/' + id;
            $('.modal').modal('show');
        }
    </script>

    <script>
        function deleteCommentFunction(id) {

            var confirmed = confirm("Do you really want to delete the comment???");
            if (confirmed == true) {
                document.getElementById('delete-comment-form-' + id).submit();
            }

        }
    </script>
@endpush
