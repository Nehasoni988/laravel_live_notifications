<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function list() {
        return view('order.list',['orders' => auth()->user()->orders]);
    }

    public function create() {
       return view('order.create');
    }

    public function edit(Request $request,Order $order) {
        return view('order.edit',['order' => $order]);
    }

    public function save(Request $request) {
        $input = $request->all();
        $input['user_id'] = auth()->user()->id;
        $input['toppings'] = isset($input['toppings'])
                                ? implode(',',$input['toppings'])
                                :null;
                                // Toppings input will be in array format so need to implode
        Order::create($input);
        return redirect(route('order.list'));
    }

}
