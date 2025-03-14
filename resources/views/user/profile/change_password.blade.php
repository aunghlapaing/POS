@extends('user/layouts/master')

@section('content')
    <div class="container-fluid py-5 mt-md-5 me-md-2">
        <div class="row">
            <div class="col-md-5 offset-md-4">
                <div class="card shadow-sm">
                    <div class="card-header">

                    </div>
                    <div class="card-body">

                        <form action="{{ route('changePassword') }}" method="post">
                            @csrf
                            <label for="change_password" class="form-label mt-md-2">Old Password</label>
                            <input type="password" class="form-control mb-md-2 @error('old_password') is-invalid @enderror"
                                name="old_password" placeholder="Enter old password...">
                            @error('old_password')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                            <label for="change_password" class="form-label mt-md-2">New Password</label>
                            <input type="password" class="form-control mb-md-2 @error('new_password') is-invalid @enderror"
                                name="new_password" placeholder="Enter old password...">
                            @error('new_password')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                            <label for="change_password" class="form-label mt-md-2">Confirm Password</label>
                            <input type="password"
                                class="form-control mb-md-2 @error('confirm_password') is-invalid @enderror"
                                name="confirm_password" placeholder="Enter old password...">
                            @error('confirm_password')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                            <input type="submit" name="change" value="Change Password"
                                class="btn btn-outline-danger mt-md-3">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
