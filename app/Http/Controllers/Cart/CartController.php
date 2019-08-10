<?php

namespace App\Http\Controllers\Cart;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\CartRepository;
use App\Repositories\ProductRepository;

class CartController extends Controller
{
    protected $cart = null;

    public function __construct(CartRepository $cart, ProductRepository $product)
    {
        $this->cart = $cart;
        $this->product = $product;
    }

    public function Cart(){
        return view('cart.data-cart');
    }

    public function addToCart(Request $request){
        $id = $request->id ;
        $products = $this->product->getById($id);

        $cart = session()->get('cart');
        // firts product cart
        if(!$cart){
            $cart = [
                $id => [
                    "name"  => $products->name_product,
                    "quantity" => $request->quantity,
                    "price" => $products->price,
                    "image" => $products->image_product
                ]
            ];
            session()->put('cart', $cart);
            return redirect('cart')->with('success', 'Product added to cart successfully!');
        }
        // second product and quantity added
        if(isset($cart[$id])){
            $quantity = $request->quantity;
            $cart[$id]['quantity'] += $quantity;

            session()->put('cart', $cart);
            return redirect('cart')->with('success', 'Product added to cart successfully!');
        }
        // item product null and added quantity 1
        $cart[$id] = [
                "name"  => $products->name_product,
                "quantity" => $request->quantity,
                "price" => $products->price,
                "image" => $products->image_product
        ];
        session()->put('cart', $cart);
        return redirect('cart')->with('success', 'Product added to cart successfully!');
    }

    public function updateCart(Request $request){
        if($request->id and $request->quantity)
        {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }
    
    public function deleteCart(Request $request){
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }
}
