<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Auth::user()->orders()->latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        // prevent other users from accessing the order
        abort_if($order->user_id !== Auth::id(), 403);

        return view('orders.show', compact('order'));
    }
}
