@extends('admin/layouts/master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-7 offset-md3">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('paymentUpdate', $paymentData->id) }}" method="post">
                            @csrf

                            <label for="payment" class="form-label" name="AccountID">Account ID</label>
                            <input type="text" name="account_number" placeholder="Enter Account Number..." value="{{ $paymentData->account_number, old('account_number') }}" class="form-control mb-md-2 @error('account_number') is-invalid @enderror">
                            @error('account_number')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror

                            <label for="payment" class="form-label" name="AccountType">Account Type</label>
                            <input type="text" name="account_name" placeholder="Enter Account Type..." value="{{ $paymentData->account_name, old('account_name') }}" class="form-control mb-md-2 @error('account_name') is-invalid @enderror">
                            @error('account_name')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror

                            <label for="payment" class="form-label" name="ServiceProvider">Service Provider</label>
                            <input type="text" name="type" placeholder="Enter Service Provider..." value="{{ $paymentData->type, old('type') }}" class="form-control mb-md-2 @error('type') is-invalid @enderror">
                            @error('type')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        
                            <input type="submit" name="Create" class="btn btn-primary mt-md-3 shadow-sm" value="Update">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection