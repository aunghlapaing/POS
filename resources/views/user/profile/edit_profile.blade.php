@extends('user/layouts/master')

@section('content')
<div class="container-fluid col-md-10 py-5 mt-5">
    <div class="card">
        <div class="card-body shadow-sm">
            <form action="{{ route('updateProfile', $userData->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <img src="{{ asset('user/profile/' . $userData->profile) }}" style="width:150; height:150px;">
                        <input type="file" accept="image/*" name="profile"
                            class="form-control mt-1 @error('profile') is-invalid @enderror" id="output"
                            onchange="loadFile(event)">
                        @error('profile')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="name" class="form-label mt-md-2">Name</label>
                        <input type="text" class="form-control mb-md-2 @error('first_name') is-invalid @enderror"
                            name="first_name" placeholder="Enter name..." value="{{ Auth::user()->first_name, old('first_name') }}">
                        @error('first_name')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror

                        <label for="email" class="form-label mt-md-2">Email</label>
                        <input type="text" name="email" class="form-control mb-md-2 @error('email') is-invalid @enderror"
                            placeholder="Enter email..." id="" value="{{ Auth::user()->email == "" ? old('email') : Auth::user()->email}}">
                        @error('email')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror

                        <label for="phone" class="form-label mt-md-2">Phone</label>
                        <input type="text" class="form-control mb-md-2 @error('phone') is-invalid @enderror" name="phone"
                            placeholder="Enter phone number..." value="{{ Auth::user()->phone =="" ? old('phone') :Auth::user()->phone }}">
                        @error('phone')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror

                        <label for="address" class="form-label mt-md-2">Address</label>
                        <input type="text" name="address" class="form-control mb-md-2 @error('address') is-invalid @enderror"
                            placeholder="Enter address..." value="{{ Auth::user()->address =="" ? old('address') : Auth::user()->address }}">
                        @error('address')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror

                        <input type="submit" name="update" value="Update" class="btn btn-outline-danger mt-md-3">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
