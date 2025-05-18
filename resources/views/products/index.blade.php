<form method="GET" action="{{ route('products.index') }}" class="mb-4">
    <div class="row g-2">
        <div class="col-md-3">
            <input type="text" name="search" class="form-control" placeholder="Search..." value="{{ request('search') }}">
        </div>
        <div class="col-md-3">
            <select name="category" class="form-select">
                <option value="">All Categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ ucfirst($cat) }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <input type="number" name="min_price" class="form-control" placeholder="Min Price" value="{{ request('min_price') }}">
        </div>
        <div class="col-md-2">
            <input type="number" name="max_price" class="form-control" placeholder="Max Price" value="{{ request('max_price') }}">
        </div>
        <div class="col-md-2">
            <button class="btn btn-outline-primary w-100">Filter</button>
        </div>
    </div>
</form>
