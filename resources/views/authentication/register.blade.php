@extends('authentication.layouts.master')

@section('content')

<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block bg-register-image">
                    {{-- image replace here --}}
                </div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                        </div>
                        <form class="user" method="post" action="{{ url('register') }}">

                            @csrf
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" name="first_name" class="form-control form-control-user" id="exampleFirstName"
                                        placeholder="First Name" value="{{ old('first_name') }}">
                                        @error ('first_name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" name="last_name" class="form-control form-control-user" id="exampleLastName"
                                        placeholder="Last Name" value="{{ old('last_name') }}">
                                        @error ('last_name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="email" name="email"  class="form-control form-control-user" id="exampleInputEmail"
                                    placeholder="Email Address" value="{{ old("email") }}">
                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" name="password" class="form-control form-control-user"
                                        id="exampleInputPassword" placeholder="Password">
                                        @error ('password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                </div>
                                <div class="col-sm-6">
                                    <input type="password"name="confirm_password" class="form-control form-control-user"
                                        id="exampleRepeatPassword" placeholder="Repeat Password">
                                        @error('confirm_password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Register Account
                            </button>
                            <hr>
                            <a href="{{ route('socialRedirect', 'google') }}" class="btn btn-google btn-user btn-block">
                                <i class="fab fa-google fa-fw"></i> Register with Google
                            </a>
                            <a href="{{ route('socialRedirect', 'github') }}" class="btn btn-facebook btn-user btn-block">
                                <i class="fa-brands fa-github"></i> Register with Github
                            </a>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="forgot-password.html">Forgot Password?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="{{ route('login')}}">Already have an account? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection