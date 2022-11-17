     <h2>Ваш заказ принят, ожидайте звонка</h2>
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
                                        <p>{{ $cart_data['price'] }}</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="o-pro-qty">
                                        <p>{{ $cart_data['quantity'] }}</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="o-pro-subtotal">
                                        <p>{{ $cart_data['price'] * $cart_data['quantity'] }}</p>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    @endforeach


                    <tfoot>
                        <tr>
                            <td colspan="3">Grand Total</td>
                            <td colspan="1">${{ $order->total_sum }}</td>
                        </tr>
                    </tfoot>
                </table>
            @endforeach
        </div>
