@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mt-2">
                    <div class="card-header bg-primary text-white">
                        Change Password
                    </div>

                    <div class="card-body bg-dark text-white">
                        <form method="POST" action="{{ route('updatePassword') }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <input type="password" id="first-name" class="form-control col-md-7 col-xs-12"
                                    placeholder="Enter old password" name="oldpassword">
                            </div>

                            <div class="form-group">
                                <input type="password" id="first-name" placeholder="Enter new password"
                                    class="form-control col-md-7 col-xs-12" name="newpassword">
                            </div>

                            <div class="form-group">
                                <input type="password" id="first-name" class="form-control col-md-7 col-xs-12"
                                    placeholder="Enter password confirmation" name="password_confirmation">
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
