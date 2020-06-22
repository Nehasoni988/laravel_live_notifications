<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use App\Events\OrderStatusUpdated;

class AdminOrderController extends Controller
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
        return view('order.list',['orders' => Order::all()]);
    }

    public function updateStatus(Request $request,Order $order) {
        $order->update(['status' => $request->input('status')]);
        // Dispatch order status update event
        event(new OrderStatusUpdated($order));
        return back()->with('message', 'Order Status updated successfully!');;
    }

}
