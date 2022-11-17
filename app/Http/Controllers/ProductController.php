<?php

namespace App\Http\Controllers;

use App\Mail\OrderIn;
use App\Mail\OrderOut;
use App\Models\Order;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
    public function checkout()
    {
        $user = Auth::user();
        $sessionId = Session::getId();
        \Cart::session($sessionId);
        $cart = \Cart::getContent();
        // dd($cart);
        $sum = \Cart::getTotal('price');

        $messageSuccessOrder = \session('successOrder');
        // dd($user->getAuthIdentifier());
        // dd($user);
        $orders = Order::query()->where(['user_id' => $user->getAuthIdentifier()])->orderBy('id', 'desc')->get();
        // dd($orders);
        $orders->transform(function ($order) {
            $order->cart_data = unserialize($order->cart_data);
            // dd($order->cart_data);
            return $order;
        });

        if (!empty($messageSuccessOrder)) {
            return view('pet-shop/checkout', [
                'cart' => $cart,
                'sum' => $sum,
                'user' => $user,
                'orders' => $orders,
            ])->with('messageSuccessOrder', $messageSuccessOrder);

        }

        return view('pet-shop/checkout', [
            'cart' => $cart,
            'sum' => $sum,
            'user' => $user,
            'orders' => $orders,
        ])->with('messageSuccessOrder', $messageSuccessOrder);
    }

    public function profile()
    {
        $sessionId = Session::getId();
        \Cart::session($sessionId);
        $cart = \Cart::getContent();
        $sum = \Cart::getTotal('price');

        return view('pet-shop/my-account', [
            'cart' => $cart,
            'sum' => $sum,
        ]);
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

    public function makeOrder(Request $request)
    {
        $user = Auth::user();

        $sessionId = Session::getId();
        \Cart::session($sessionId);
        $cart = \Cart::getContent();
        $sum = \Cart::getTotal('price');

        $order = new Order();
        $order->user_id = $user->id;
        $order->cart_data = $order->setCartDataAttribute($cart);
        $order->total_sum = $sum;
        $order->address = $request->address . ' ' . $request->city . ' ' . $request->post;
        $order->phone = $request->phone;
        $order->save();
        if ($order->save()) {
            Mail::to($request->user())->send(new OrderIn([
                'cart' => $cart,
                'sum' => $sum,
            ]));
            Mail::to($request->user())->send(new OrderOut([
                'cart' => $cart,
                'sum' => $sum,
            ]));
            \Cart::clear();
            Session::flash('successOrder', 'Order created successfully');
            return back();
        }
        Session::flash('errorOrder', 'something went wrong');

        return back();
        // dd($request);
    }
}
