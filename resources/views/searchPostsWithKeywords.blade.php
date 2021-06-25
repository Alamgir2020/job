@extends('layouts.app')
@section('title')
    Search Posts With Keywords
@endsection

@section('content')

    <div class="container">
        @include('partials.heading')
        <div class="bg-info text-capitalize text-white text-center p-2 my-2">
            <h4 class="my-3">
                Search Posts With Keywords
            </h4>
        </div>
        <div class="card card-default">
            <div class="card-header bg-success text-capitalize">
                <h3>Search a post </h3>
            </div>
            <div class="card-body bg-info">
                <div class="form-group">
                    <input type="text" class="form-control" id="search" name="search"
                        placeholder="Search for posts"></input>
                </div>

                <ul class="list-group" id="searchResult">

                </ul>
            </div>
        </div>

    </div>
@endsection

@push('js')

    <script type="text/javascript">
        $('#search').on('keyup', function() {

            var value = $(this).val();
            $.ajax({
                type: 'get',
                url: '{{ URL::to('search') }}',

                data: {
                    'search': value
                },
                success: function(data) {
                    // $('tbody').html(data);
                    $('#searchResult').html(data);
                }
            });
        })
    </script>

@endpush
