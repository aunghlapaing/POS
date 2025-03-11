@extends('admin/layouts/master')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4 col">
            <div class="card-header py-3">
                <div class="">
                    <div class="">
                        <h6 class="m-0 font-weight-bold text-primary">Admin Profile ( <span class="text-danger"> Role</span> )
                        </h6>
                    </div>
                </div>
            </div>
            <form action="{{ route('editProfile', $userData->id) }}" method="post" enctype="multipart/form-data">

                @csrf
                <input type="hidden" name="oldProfile" value="{{ $userData->profile }}">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <img class="img-profile img-thumbnail" id="output" src="{{ asset('admin/profile/'. $userData->profile ) }}">
                            <input type="file" name="image" id="" class="form-control mt-1 @error('image') is-invalid @enderror" onchange="loadFile(event)">
                            @error('image')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">
                                            Name</label>
                                        <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror " placeholder="Name..."value="{{ $userData->first_name, old('first_name') }}">
                                        @error('first_name')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">
                                            Email</label>
                                        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $userData->email, old('email') }}" placeholder="Email...">
                                        @error('email')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">
                                            Phone</label>
                                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ $userData->phone, old('phone') }}" placeholder="09xxxxxx">
                                        @error('phone')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">
                                            Address</label>
                                        <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ $userData->address, old('address') }}" placeholder="Address">
                                        @error('address')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <input type="submit" name="btn_submit" value="Update" class="btn btn-primary mt-3">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection