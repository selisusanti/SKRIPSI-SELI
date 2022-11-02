@extends('layouts.layouts')
@section('title', 'Profile')
@section('content')

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cart-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th class="p-name">Product Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th><i class="ti-close"></i></th>
                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    $total = 0 ;
                                @endphp

                                @if(isset($cartItems))
                                    @foreach ($cartItems as $item)
                                            <tr>
                                                <td class="cart-pic first-row"><img src="{{ $item->associatedModel->image ?? '' }}" alt=""></td>
                                                <td class="cart-title first-row">
                                                    <h5>Pure Pineapple</h5>
                                                </td>
                                                <td class="p-price first-row">{{ number_format($item->price ?? '','0') }} </td>
                                                <td class="qua-col first-row">
                                                    <form action="/cart/update" method="POST">
                                                        @csrf
                                                        <div class="quantity">
                                                            <div class="pro-qty">
                                                                <input type="text" name="jumlah" value="{{ $item->quantity ?? '0' }}">
                                                            </div>
                                                                <input type="hidden" name="id" value="{{ $item->id ?? '0' }}">
                                                            <div class="order-btn">
                                                                <button type="submit" class="site-btn">UBAH</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </td>
                                                @php
                                                    $harga = $item->price * $item->quantity;
                                                    $total = $total + $harga;
                                                @endphp
                                                <td class="total-price first-row">{{ number_format($harga ?? '','0') }}</td>
                                                <td class="close-td first-row">
                                                    <form action="/cart/remove" method="POST">
                                                        @csrf
                                                        <input type="hidden" value="{{ $item->id }}" name="id">
                                                        <div class="order-btn">
                                                            <button type="submit" class="site-btn place-btn">x</button>
                                                        </div>
                                                    </form>
                                                </td>
                                            </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <!-- <div class="cart-buttons">
                                <a href="#" class="primary-btn continue-shop">Continue shopping</a>
                                <a href="#" class="primary-btn up-cart">Update cart</a>
                            </div> -->
                            <div class="discount-coupon">
                                <h6>Discount Codes</h6>
                                <form action="#" class="coupon-form">
                                    <input type="text" placeholder="Enter your codes">
                                    <button type="submit" class="site-btn coupon-btn">Apply</button>
                                </form>
                            </div>
                        </div>
                        @php
                            $total_akhir = 0;
                            $total_akhir = $total + 0 ;
                        @endphp
                        <div class="col-lg-4 offset-lg-4">
                            <div class="proceed-checkout">
                                <ul>
                                    <li class="subtotal">Subtotal <span>{{ number_format($total ?? '','0') }}</span></li>
                                    <li class="cart-total">Total <span>{{ number_format($total_akhir ?? '','0') }}</span></li>
                                </ul>
                                <a href="#" class="proceed-btn">PROCEED TO CHECK OUT</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->

    <!-- Partner Logo Section Begin -->
    <div class="partner-logo">
        <div class="container">
            <div class="logo-carousel owl-carousel">
                <div class="logo-item">
                    <div class="tablecell-inner">
                        <img src="img/logo-carousel/logo-1.png" alt="">
                    </div>
                </div>
                <div class="logo-item">
                    <div class="tablecell-inner">
                        <img src="img/logo-carousel/logo-2.png" alt="">
                    </div>
                </div>
                <div class="logo-item">
                    <div class="tablecell-inner">
                        <img src="img/logo-carousel/logo-3.png" alt="">
                    </div>
                </div>
                <div class="logo-item">
                    <div class="tablecell-inner">
                        <img src="img/logo-carousel/logo-4.png" alt="">
                    </div>
                </div>
                <div class="logo-item">
                    <div class="tablecell-inner">
                        <img src="img/logo-carousel/logo-5.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Partner Logo Section End -->
@endsection