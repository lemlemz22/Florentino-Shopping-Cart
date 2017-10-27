<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CartItem;
use App\Cart;
use Auth;

class ProductsController extends Controller
{
	public function showCart() {
    	$id = Auth::user()->user_id;
    	$cart_id = Cart::where('carts.user_id', $id)->value('id');

        $cart_count = CartItem::join('carts', 'carts.id', '=', 'cart_items.cart_id')->where('carts.user_id', $id)->count();
    	$products = CartItem::where('cart_id', $cart_id)->get();
		return view ('cart', compact('products', 'cart_count'));
	}

    public function addToCart(Request $request) {
    	$id = Auth::user()->user_id;
    	$cart_id = Cart::where('carts.user_id', $id)->value('id');
    	$product_id = $request -> product_id;
        $name = $request -> name;
        $path = $request -> path;
        $category_id = $request -> category_id;
    	$quantity = $request -> quantity;
    	$amount = $request -> amount;
    	$barcode = $request -> barcode;

    	$product = new CartItem;
    	$product -> cart_id = $cart_id;
    	$product -> product_id = $product_id;
        $product -> name = $name;
        $product -> path = $path;
        $product -> category_id = $category_id;
    	$product -> quantity = $quantity;
    	$product -> amount = $amount;
    	$product -> barcode = $barcode;
    	$product -> save();

    	return redirect ('/home');
    }

    public function updateQuantity(Request $request) {
        $quantity = $request -> quantity;
        $product_id = $request -> product_id;
        $id = Auth::user()->user_id;
        $name = Auth::user()->name;
        $cart_id = Cart::where('carts.user_id', $id)->value('id');

        $update = CartItem::where([
            ['product_id', $product_id],
            ['cart_id', $cart_id],
        ])->update(['quantity' => $quantity]);

        return redirect ('/cart/'.$name.$id.str_random(10));
    }

    public function deleteItem(Request $request) {
        $product_id = $request -> product_id;
        $id = Auth::user()->user_id;
        $name = Auth::user()->name;
        $cart_id = Cart::where('carts.user_id', $id)->value('id');

        $delete = CartItem::where([
            ['product_id', $product_id],
            ['cart_id', $cart_id],
        ])->delete();

        return redirect ('/cart/'.$name.$id.str_random(10));
    }
}
