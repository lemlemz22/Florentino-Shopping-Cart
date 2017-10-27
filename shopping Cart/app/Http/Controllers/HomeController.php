<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\CartItem;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->user_id;

        $products = Product::all();
        $cart_count = CartItem::join('carts', 'carts.id', '=', 'cart_items.cart_id')->where('carts.user_id', $user_id)->count();
        
        return view('home', compact('products', 'cart_count'));
    }
}
