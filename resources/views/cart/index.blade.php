@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Your Cart</h3>

    @if($items->isEmpty())
        <p>No items in cart.</p>
    @else
        <ul class="list-group mb-3">
          @foreach($items as $item)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        {{ $item->product->name }} (x{{ $item->quantity }})
                        <br>
                        <small>${{ $item->product->price }} each</small>
                    </div>

                    <div class="d-flex align-items-center">
                        <span class="me-3 fw-semibold">${{ $item->product->price * $item->quantity }}</span>

                        <form action="{{ route('cart.remove', $item->id) }}" method="POST" onsubmit="return confirm('Remove this item from cart?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Remove</button>
                        </form>
                    </div>
                </li>
            @endforeach
            <li class="list-group-item d-flex justify-content-between fw-bold">
                Total: <span>${{ number_format($total, 2) }}</span>
            </li>
        </ul>

        <form action="{{ route('cart.checkout') }}" method="POST">
            @csrf
            <button class="btn btn-primary">Checkout</button>
        </form>
    @endif
</div>
@endsection
