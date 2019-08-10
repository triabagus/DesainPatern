<?php

namespace App\Http\Controllers\Cart;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\CartRepository;

class CartController extends Controller
{
    protected $cart = null;

    public function __construct(CartRepository $cart)
    {
        $this->cart = $cart;
    }

    public function addCart(Request $request){
        session_start();
        
        $collection_ids = array($request->id); 
        $collection_string = join(",", $collection_ids);

        session(['user_carts' => $collection_string]); 
        // ambil string dari session yang sudah disimpan. 
        $user_carts = session("user_carts"); // => "23,42,451"
        // ubah string tadi menjadi array 
        $user_carts_arr = explode(",", $collection_string);

        dd($_SESSION['user_carts']);
        // session_destroy();
        // return view('cart.data-cart');
    }
}
