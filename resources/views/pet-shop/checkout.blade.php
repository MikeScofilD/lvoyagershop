@extends('layouts.master')

@section('title')
    Lorem ipsum dolor sit amet, co adipisi elit, sed eiusmod tempor incididunt ut labore
    et dolore
@endsection
@section('styles')
@endsection
@section('content')
    @if ($messageSuccessOrder)
        <h1 style="color: blue">{{ $messageSuccessOrder }}</h1>
    @endif
    <div class="breadcrumb-area pt-95 pb-95 bg-img" style="background-image:url(assets/img/banner/banner-2.jpg);">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <h2>Checkout</h2>
                <ul>
                    <li><a href="index.html">home</a></li>
                    <li class="active">Checkout</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- shopping-cart-area start -->
    <div class="checkout-area pt-95 pb-70">
        <div class="container">
            <h3 class="page-title">checkout</h3>
            <div class="row">
                <div class="col-lg-9">
                    <div class="checkout-wrapper">
                        <div id="faq" class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 class="panel-title"><span>1</span> <a data-toggle="collapse" data-parent="#faq"
                                            href="#payment-1">billing information</a></h5>
                                </div>
                                <div id="payment-1" class="panel-collapse collapse">
                                    <form action="{{ route('pet-shop/make-order') }}" method="post">
                                        @csrf
                                        <div class="panel-body">
                                            <div class="billing-information-wrapper">
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="billing-info">
                                                            <label>First Name</label>
                                                            <input type="text" name="name"
                                                                value="{{ $user->name }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="billing-info">
                                                            <label>Email Address</label>
                                                            <input type="email" name="email"
                                                                value="{{ $user->email }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="billing-info">
                                                            <label>Address</label>
                                                            <input type="text" name="address">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="billing-info">
                                                            <label>city</label>
                                                            <input type="text" name="city">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="billing-info">
                                                            <label>State/Province</label>
                                                            <input type="text" name="state">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="billing-info">
                                                            <label>Zip/Postal Code</label>
                                                            <input type="text" name="zip">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="billing-info">
                                                            <label>Telephone</label>
                                                            <input type="text" name="phone">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="order-review">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th class="width-1">Product Name</th>
                                                                    <th class="width-2">Price</th>
                                                                    <th class="width-3">Qty</th>
                                                                    <th class="width-4">Subtotal</th>
                                                                </tr>
                                                            </thead>
                                                            @foreach ($cart as $item)
                                                                <tbody>
                                                                    <tr>
                                                                        <td>
                                                                            <div class="o-pro-dec">
                                                                                <p>Fusce aliquam</p>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="o-pro-price">
                                                                                <p>${{ $item->price }}</p>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="o-pro-qty">
                                                                                <p>{{ $item->quantity }}</p>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="o-pro-subtotal">
                                                                                <p>${{ $item->price * $item->quantity }}</p>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            @endforeach
                                                            <tfoot>
                                                                <tr>
                                                                    <td colspan="3">Grand Total</td>
                                                                    <td colspan="1">${{ $sum }}</td>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="billing-back-btn">
                                                    <div class="billing-btn">
                                                        <button type="submit">Make Order</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 class="panel-title"><span>2</span> <a data-toggle="collapse" data-parent="#faq"
                                            href="#payment-2">History of orders</a></h5>
                                </div>
                                <div id="payment-2" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="order-review-wrapper">
                                            <div class="order-review">
                                                <div class="table-responsive">
                                                    @foreach ($orders as $order)
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th class="width-1">Product Name</th>
                                                                    <th class="width-2">Price</th>
                                                                    <th class="width-3">Qty</th>
                                                                    <th class="width-4">Subtotal</th>
                                                                </tr>
                                                            </thead>
                                                            @foreach ($order->cart_data as $cart_data)

                                                                <tbody>
                                                                    <tr>
                                                                        <td>
                                                                            <div class="o-pro-dec">
                                                                                <p>{{ $cart_data['name'] }}</p>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="o-pro-price">
                                                                                <p>{{$cart_data['price']}}</p>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="o-pro-qty">
                                                                                <p>{{$cart_data['quantity']}}</p>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="o-pro-subtotal">
                                                                                <p>{{$cart_data['price'] * $cart_data['quantity']}}</p>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            @endforeach


                                                            <tfoot>
                                                                <tr>
                                                                    <td colspan="3">Grand Total</td>
                                                                    <td colspan="1">${{$order->total_sum}}</td>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                    @endforeach
                                                </div>
                                                <div class="billing-back-btn">
                                                    <span>
                                                        Forgot an Item?
                                                        <a href="#"> Edit Your Cart.</a>

                                                    </span>
                                                    <div class="billing-btn">
                                                        <button type="submit">Continue</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="checkout-progress">
                        <h4>Checkout Progress</h4>
                        <ul>
                            <li>Billing Address</li>
                            <li>Shipping Address</li>
                            <li>Shipping Method</li>
                            <li>Payment Method</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
