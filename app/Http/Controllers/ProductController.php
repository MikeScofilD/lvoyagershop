<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function shopList()
    {
        $products = Product::all();
        $products = Product::query()->select()->where(['id' => 2])->get();
        // return "jello";
        return view('pet-shop/shop-page', ['products'=>$products]);
    }

    public function shopIndex()
    {
        $randProducts = Product::query()->inRandomOrder()->limit(4)->get();
        $product = Product::query()->select()->where(['id'=>1])->get();
        // dd($product->id);
        // $randProducts = [1,2,3,5];
        // dd($randProducts);
        return view('pet-shop/index', ['randProducts' => $randProducts, 'product'=>$product]);
    }

    public function productDetails(Request $request)
    {
        // dd($request);
        $product = Product::query()->where(['id'=>$request->id])->get();
        // dd($product);
        return view('pet-shop/product-details',['product'=>$product]);
    }
}
