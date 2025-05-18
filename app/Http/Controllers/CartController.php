<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Product;


class CartController extends Controller
{
    public function add(Product $product)
    {
        $cartItem = CartItem::where('user_id', auth()->id())
        ->where('product_id', $product->id)
        ->first();

        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            CartItem::create([
                'user_id' => auth()->id(),
                'product_id' => $product->id,
                'quantity' => 1, // ✅ start with 1
            ]);
        }
        return back()->with('success', 'Added to cart');
    }

    public function index()
    {
        $items = CartItem::with('product')->where('user_id', auth()->id())->get();

        $total = $items->sum(fn($item) => $item->product->price * $item->quantity);

        return view('cart.index', compact('items', 'total'));
    }

    public function checkout()
    {
        $user = auth()->user();
        $items = $user->cartItems()->with('product')->get();
        $total = $items->sum(fn($item) => $item->product->price * $item->quantity);

        $order = $user->orders()->create(['total_price' => $total]);

        foreach ($items as $item) {
            $order->items()->create([
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);
        }

        CartItem::where('user_id', $user->id)->delete();

        return redirect()->route('cart.index')->with('success', 'Order placed!');
    }
    public function destroy($id)
    {
        $cartItem = CartItem::where('id', $id)->where('user_id', auth()->id())->first();

        if ($cartItem) {
            $cartItem->delete();
            return redirect()->back()->with('success', 'Item removed from cart.');
        }

        return redirect()->back()->with('error', 'Item not found.');
    }
}
