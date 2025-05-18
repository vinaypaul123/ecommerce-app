@extends('layouts.app')

@section('content')
<div class="container">
    <h2>All Products</h2>

    <form method="GET" class="row g-3 mb-4">
        <div class="col-md-3">
            <input type="text" name="search" class="form-control" placeholder="Search..." value="{{ request('search') }}">
        </div>
        <div class="col-md-3">
            <input type="number" name="min_price" step="0.01" class="form-control" placeholder="Min Price" value="{{ request('min_price') }}">
        </div>
        <div class="col-md-3">
            <input type="number" name="max_price" step="0.01" class="form-control" placeholder="Max Price" value="{{ request('max_price') }}">
        </div>
        <div class="col-md-3">
            <button class="btn btn-outline-primary">Filter</button>
        </div>
    </form>

    <div class="row">
        @foreach($products as $product)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" width="100" height="100" class="card-img-top" alt="Product Image">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p>{{ Str::limit($product->description, 100) }}</p>
                    <p><strong>${{ number_format($product->price, 2) }}</strong></p>
                    <form method="POST" action="{{ route('cart.add', $product->id) }}">
                        @csrf
                        <button class="btn btn-sm btn-success">Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{ $products->links() }}
</div>
@endsection
