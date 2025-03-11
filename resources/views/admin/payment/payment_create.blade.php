@extends('admin/layouts/master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 ">
                <div class="card shadow-sm">
                    <div class="card-header py-3">
                        <div class="">
                            <h6 class="m-0 font-weight-bold text-primary">Create Payment Page</h6>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('paymentCreate') }}" method="post">
                            @csrf

                            <label for="payment" class="form-label" name="AccountID">Account ID</label>
                            <input type="text" name="account_number" placeholder="Enter Account Number..." value="{{ old('account_number') }}" class="form-control mb-md-2 @error('account_number') is-invalid @enderror">
                            @error('account_number')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror

                            <label for="payment" class="form-label" name="AccountType">Account Type</label>
                            <input type="text" name="account_name" placeholder="Enter Account Type..." value="{{ old('account_name') }}" class="form-control mb-md-2 @error('account_name') is-invalid @enderror">
                            @error('account_name')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror

                            <label for="payment" class="form-label" name="ServiceProvider">Service Provider</label>
                            <input type="text" name="type" placeholder="Enter Service Provider..." value="{{ old('type') }}" class="form-control mb-md-2 @error('type') is-invalid @enderror">
                            @error('type')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        
                            <input type="submit" name="Create" class="btn btn-primary mt-md-3 shadow-sm" value="Create">
                        </form>
                    </div>
                </div>
            </div>
    
            <div class="col-md-7 ">
                <div class="card shadow-sm">
                    <div class="card-header py-3">
                        <div class="">
                            <h6 class="m-0 font-weight-bold text-primary">Payment List Page</h6>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table" id="dataTable" width="100%" cellspacing="0">
                            <tr>
                                <th>ID</th>
                                <th>Account Number</th>
                                <th>Account Type</th>
                                <th>Provider</th>
                                <th></th>
                            </tr>
                            @foreach ($paymentData as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->account_number }}</td>
                                    <td>{{ $item->account_name }}</td>
                                    <td>{{ $item->type }}</td>
                                    <td>
                                        <a href="{{ route('paymentEditPage', $item->id) }}" class="btn btn-outline-primary btn-sm">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </a>

                                        <button type="button" class="btn btn-outline-danger btn-sm" id="" onclick="deleteProcess({{ $item->id }})">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                
                            @endforeach 
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js-script')
<script>
    function deleteProcess($id)
    {
        Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success"
                    });
                    setInterval(() => {
                        location.href = '/admin/payment/delete/' + $id
                    }, 1000);
                }
            });
    }
</script>
@endsection