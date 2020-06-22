@extends('layouts.app')

@section('content')
<div class="container">
    <notifications-alert-component user_id="{{auth()->user()->id}}"></notifications-alert-component>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Order Id</th>
                @if(auth()->user()->is_admin)
                <th scope="col">Customer</th>
                @endif
                <th scope="col">Delivery Address</th>
                <th scope="col">Quantity</th>
                <th scope="col">Pizza Size</th>
                <th scope="col">Toppings</th>
                <th scope="col">Instructions</th>
                <th scope="col">Status</th>
                @if(auth()->user()->is_admin)
                <th scope="col">Action</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
            <tr>
                <th scope="row">{{$order->id}}</th>
                @if(auth()->user()->is_admin)
                <td>{{ $order->user->name }}</td>
                @endif
                <td>{{$order->address}}</td>
                <td>{{$order->quantity}}</td>
                <td>{{SIZES_STRING[$order->size]}}</td>
                <td>
                    {{$order->toppings}}
                </td>
                <td>{{$order->instructions}}</td>
                <td>
                    {{STATUS_STRING[$order->status]}}</td>
                @if(auth()->user()->is_admin)
                <td>
                    <a href="{{ route('order.edit',['order' => $order->id]) }}">Edit</a>
                </td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
