@extends('layouts.layouts')
@section('title', 'Profile')
@section('content')

    @if(Session::has('error'))
        @php
            $errorLogin = Session::get('error');
        @endphp
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ $errorLogin }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @else
        @if(isset($diskon) && !empty($diskon))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong class="center">Diskon berhasil dipasang</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    @endif



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
                                    $data_cart = Session::get('cartItems');
                                @endphp

                                @if(isset($data_cart))
                                    @foreach ($data_cart as $item)
                                            <tr>
                                                <td class="cart-pic first-row"><img src="{{ $item->detailProduk->image ?? '' }}" alt=""></td>
                                                <td class="cart-title first-row">
                                                    <h5>Pure Pineapple</h5>
                                                </td>
                                                <td class="p-price first-row">{{ $item->detailProduk->harga }} </td>
                                                <td class="qua-col first-row">
                                                    <form action="/cart/update" method="POST">
                                                        @csrf
                                                        <div class="quantity">
                                                            <div class="pro-qty">
                                                                <input type="text" name="jumlah" value="{{ $item->quantity ?? '0' }}">
                                                            </div>
                                                                <input type="hidden" name="produk_id" value="{{ $item->produk_id ?? '0' }}">
                                                            <div class="order-btn">
                                                                <button type="submit" class="site-btn">UBAH</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </td>
                                                @php
                                                    $harga = $item->detailProduk->harga * $item->quantity;
                                                    $total = $total + $harga;
                                                @endphp
                                                <td class="total-price first-row">{{ number_format($harga ?? '','0') }}</td>
                                                <td class="close-td first-row">
                                                    <form action="/cart/remove" method="POST">
                                                        @csrf
                                                        <input type="hidden" value="{{ $item->id }}" name="produk_id">
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
                                <form action="/cart" class="coupon-form" method="get">
                                    @csrf
                                    <!-- <input type="hidden" value="get" _method="get"> -->
                                    <input type="text" required value="{{ $kode ?? '' }}" name="code" max='10' placeholder="Enter your codes">
                                    <button type="submit" class="site-btn coupon-btn">Apply</button>
                                </form>
                            </div>
                        </div>

                        @php

                            if(isset($diskon)){
                                $potongan     = '10';
                                $max_potongan = '100000';
                                $total_diskon = ($total * 10) / 100 ;

                                if($total_diskon > $max_potongan){
                                    $total_diskon = $max_potongan;
                                }
                            }else{
                                $total_diskon    = 0;
                            }


                            $total_akhir = 0;
                            $total_akhir = $total - $total_diskon;
                        @endphp
                        <div class="col-lg-4 offset-lg-4">
                            <div class="proceed-checkout">
                                <ul>
                                    <li class="subtotal">Subtotal <span>{{ number_format($total ?? '','0') }}</span></li>
                                    <li class="subtotal">Diskon <span>{{ number_format($total_diskon ?? '','0') }}</span></li>
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