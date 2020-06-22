@extends('layouts.app')

@section('content')
<div class="container">
    <form method="post" action="/order/save">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Delivery address</label>
            <input required type="text" name="address" class="form-control" id="exampleInputEmail1"
                aria-describedby="emailHelp">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Quantity</label>
            <input required type="number" name="quantity" class="form-control"
                id="exampleInputPassword1">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Size</label>
            <select required class="form-control form-control-lg" name="size">
                @foreach (SIZES as $size => $value)
                <option value={{$value}}>{{ $size }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Toppings</label>
            <div class="form-check form-check-inline">
                @foreach (TOPPINGS as $item)
                <input class="form-check-input" name="toppings[]" type="checkbox"
                    value={{$item}} id="defaultCheck1">
                &ensp;
                <label class="form-check-label" for="defaultCheck1">
                    {{$item}}
                </label>
                &ensp;
                @endforeach
            </div>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Any Instructions</label>
            <textarea required class="form-control" name="instructions"
                id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
