<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function shopList()
    {
        $products = Product::all();
        $products = Product::query()->select()->where(['id' => 2])->get();
        // return "jello";

        $sessionId = Session::getId();
        \Cart::session($sessionId);
        $cart = \Cart::getContent();
        $sum = \Cart::getTotal('price');

        return view('pet-shop/shop-page', ['products' => $products, 'cart' => $cart,
            'sum' => $sum]);
    }

    public function shopIndex()
    {
        $randProducts = Product::query()->inRandomOrder()->limit(4)->get();
        $product = Product::query()->select()->where(['id' => 1])->get();

        $sessionId = Session::getId();
        \Cart::session($sessionId);
        $cart = \Cart::getContent();
        $sum = \Cart::getTotal('price');
        // dd($cart);

        // dd($product->id);
        // $randProducts = [1,2,3,5];
        // dd($randProducts);
        return view('pet-shop/index', ['randProducts' => $randProducts, 'product' => $product, 'cart' => $cart, 'sum' => $sum]);
    }

    public function productDetails(Request $request)
    {
        // dd($request);
        $product = Product::query()->where(['id' => $request->id])->get();
        // dd($product);
        return view('pet-shop/product-details', ['product' => $product]);
    }

    public function addCart(Request $request)
    {
        $product = Product::query()->where(['id' => $request->id])->first();
        $sessionId = Session::getId();

        \Cart::session($sessionId)->add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $request->qty ?? 1,
            'attributes' => [
                'image' => $product->img,
            ],
        ]);

        $cart = \Cart::getContent();

        return redirect()->back();

    }

    public function contact()
    {
        $sessionId = Session::getId();
        \Cart::session($sessionId);
        $cart = \Cart::getContent();
        $sum = \Cart::getTotal('price');
        return view('pet-shop/contact', [
            'cart' => $cart,
            'sum' => $sum,
        ]);
    }
}
