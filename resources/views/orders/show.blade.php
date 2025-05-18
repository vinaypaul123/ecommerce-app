@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Order #{{ $order->id }}</h3>
    <p><strong>Date:</strong> {{ $order->created_at->format('d M Y') }}</p>
    <p><strong>Total:</strong> ${{ number_format($order->total_price, 2) }}</p>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product</th><th>Quantity</th><th>Unit Price</th><th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product ? $item->product->name : 'Product not available' }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ number_format($item->price, 2) }}</td>
                    <td>${{ number_format($item->price * $item->quantity, 1) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('orders.index') }}" class="btn btn-secondary mt-3">Back to Orders</a>
</div>
@endsection
