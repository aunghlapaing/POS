@extends('user.layouts.master')

@section('content')

<div class="container-fluid contact py-5">
    <div class="container py-5">
        <div class="p-5 bg-light rounded">
            <div class="row g-4">
                <div class="col-12">
                    <div class="text-center mx-auto" style="max-width: 700px;">
                        <h1 class="text-primary">Get in touch</h1>
                        <p class="mb-4">The contact form is currently inactive. Get a functional and working contact form with Ajax & PHP in a few minutes. Just copy and paste the files, add a little code and you're done. <a href="https://htmlcodex.com/contact-form">Download Now</a>.</p>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="h-100 rounded">
                        <iframe class="rounded w-100" 
                        style="height: 400px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d563.0279291807691!2d99.01615896783308!3d18.798577471617723!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30da255bbcc31f51%3A0xe04532f60a7b6d49!2z4LmA4LiX4Lit4Lij4LmM4Lih4Li04LiZ4Lit4LilIOC4reC4nuC4suC4o-C5jOC4l-C5gOC4oeC5ieC4mQ!5e1!3m2!1sen!2sth!4v1745163775053!5m2!1sen!2sth" 
                        loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
                <div class="col-lg-7">
                    <form action="{{ route('contact') }}" class="" method="post">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <input type="text" class="w-100 form-control border-0 py-3 mt-4 @error('name') is-invalid @enderror" name="name" value="{{ Auth::user()->first_name }}" placeholder="Your Name">
                        @error('name') <small class="invalid-feedback">{{ $message }}</small> @enderror
                        <input type="text" class="w-100 form-control border-0 py-3 mt-4 @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" placeholder="Enter title">
                        @error('title') <small class="invalid-feedback">{{ $message }}</small> @enderror
                        <textarea class="w-100 form-control border-0 mt-4 @error('message') is-invalid @enderror" rows="5" cols="10" name="message" value="{{ old('message') }}" placeholder="Your Message"></textarea>
                        @error('message') <small class="invalid-feedback">{{ $message }}</small> @enderror
                        <button class="w-100 btn form-control border-secondary py-3 bg-white text-primary mt-4" name="btn-submit" type="submit">Submit</button>
                    </form>
                </div>
                <div class="col-lg-5">
                    <div class="d-flex p-4 rounded mb-4 bg-white">
                        <i class="fas fa-map-marker-alt fa-2x text-primary me-4"></i>
                        <div>
                            <h4>Address</h4>
                            <p class="mb-2">123 Street Chiang Mai Thailand</p>
                        </div>
                    </div>
                    <div class="d-flex p-4 rounded mb-4 bg-white">
                        <i class="fas fa-envelope fa-2x text-primary me-4"></i>
                        <div>
                            <h4>Mail Us</h4>
                            <p class="mb-2">info@example.com</p>
                        </div>
                    </div>
                    <div class="d-flex p-4 rounded bg-white">
                        <i class="fa fa-phone-alt fa-2x text-primary me-4"></i>
                        <div>
                            <h4>Telephone</h4>
                            <p class="mb-2">(+012) 3456 7890</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection