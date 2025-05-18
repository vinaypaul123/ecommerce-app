@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Your Orders</h3>
    @foreach ($orders as $order)
        <div class="card mb-3">
            <div class="card-body">
                <strong>Order #{{ $order->id }}</strong><br>
                Placed on {{ $order->created_at->format('d M Y') }}<br>
                Total: ${{ number_format($order->total_price, 2) }}<br>
                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-primary mt-2">View Details</a>
            </div>
        </div>
    @endforeach
    {{ $orders->links() }}
</div>
@endsection
