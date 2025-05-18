@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Checkout</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <p>Total Items: {{ $totalQty }}</p>
    <p>Total Price: ${{ $total }}</p>

    <form method="POST" action="{{ route('checkout.process') }}">
        @csrf
        <button class="btn btn-success">Place Order</button>
    </form>
</div>
@endsection
