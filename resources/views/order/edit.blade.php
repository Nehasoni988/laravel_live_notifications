@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif
    <div class="container">
        <form method="post" action="/admin/order/{{$order->id}}/update_status">
            @csrf
            <div class="card-body">
                <h5 class="card-title font-weight-bold">Order Id {{ $order->id }}</h5>
                <div class="row">
                    <div class="col-md">Customer</div>
                    <div class="col-md">{{ $order->user->name }}</div>
                </div>
                <div class="row mt-2">
                    <div class="col-md">Address</div>
                    <div class="col-md">{{ $order->address }}</div>
                </div>
                <div class="row mt-2">
                    <div class="col-md">Quantity</div>
                    <div class="col-md">{{ $order->quantity }}</div>
                </div>
                <div class="row mt-2">
                    <div class="col-md">Size</div>
                    <div class="col-md">{{ SIZES_STRING[$order->size] }}</div>
                </div>
                <div class="row mt-2">
                    <div class="col-md">Toppings</div>
                    <div class="col-md">{{ $order->toppings }}</div>
                </div>
                <div class="row mt-2">
                    <div class="col-md">Instructions</div>
                    <div class="col-md">{{ $order->instructions }}</div>
                </div>
                <div class="row mt-2">
                    <div class="col-md">Status</div>
                    <div class="col-md">
                        <select class="form-control form-control-sm" name="status">
                            @foreach (STATUS as $key => $value)
                            <option value={{$value}}
                                {{ $value == $order->status ? 'selected' : ''}}>
                                {{ $key }}</option>
                            @endforeach
                        </select></div>
                </div>
                <div class="row mt-4 text-center mt-md">
                    <div class="col-md">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
