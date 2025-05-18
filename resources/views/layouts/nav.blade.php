<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4">
    <a class="navbar-brand" href="{{ url('/') }}">E-Commerce</a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav me-auto">
            @auth
                <li class="nav-item"><a class="nav-link" href="{{ route('posts.index') }}">Blog</a></li>
                {{-- <li class="nav-item"><a class="nav-link" href="#">Products</a></li> --}}
                @if(auth()->user()->role === 'admin')
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.users.index') }}">View Users</a></li>
                @endif
            @endauth
        </ul>
        <ul class="navbar-nav me-auto">
            <li class="nav-item"><a href="{{ route('products.index') }}" class="nav-link">Products</a></li>
            @auth
                <li class="nav-item"><a href="{{ route('cart.index') }}" class="nav-link">Cart</a></li>
                <li class="nav-item"><a href="{{ route('orders.index') }}" class="nav-link">My Orders</a></li>

                @if(auth()->user()->role === 'admin')
                    <li class="nav-item"><a href="{{ route('admin.products.create') }}" class="nav-link">Add Product</a></li>
                @endif
            @endauth
        </ul>
        <ul class="navbar-nav">
            @auth
                <li class="nav-item"><span class="nav-link">Hi {{ auth()->user()->name }}</span></li>
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST">@csrf
                        <button class="btn btn-link nav-link" type="submit">Logout</button>
                    </form>
                </li>
            @else
                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
            @endauth
        </ul>
    </div>
</nav>
