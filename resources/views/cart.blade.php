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
                                <div class="coupon-form">
                                    <input type="text" required value="{{ $kode ?? '' }}" id="code" name="code" max='10' placeholder="Enter your codes">
                                    <button type="submit" class="site-btn coupon-btn" id="kupon-cek">Apply</button>
                                </div>
                            </div>
                        </div>

                        @php
                        $total_diskon    = 0;
                        @endphp
                        <div class="col-lg-4 offset-lg-4">
                            <div class="proceed-checkout">
                                <ul>
                                    <li class="subtotal">Subtotal <span>{{ number_format($total ?? '','0') }}</span></li>
                                    <li class="subtotal">Diskon <span id="total_diskon">{{ number_format($total_diskon ?? '','0') }}</span></li>
                                    <li class="cart-total">Total <span id="total_akhir">{{ number_format($total ?? '','0') }}</span></li>
                                </ul>
                                    <a href="#" class="proceed-btn">PROCEED TO CHECK OUT</a>
                                    <button type="submit" class="proceed-btn">PROCEED TO CHECK OUT</button>
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

    <script type="text/javascript">
        $('#kupon-cek').click(function(){
            $.ajax({
                type: "get",
                url: "kupon",
                data: { 
                    code: $('#code').val(),  
                },
                success: function(data){
                    if(data.diskon){
                        var persen = data.diskon.persen_diskon;
                        var max    = data.diskon.max_diskon;
                        var total_pesanan    = {{ $total }};
                        var total_diskon     = (total_pesanan * persen) / 100 ;

                        if(total_diskon > max){
                            var total_diskon = max;
                        }else{
                            var total_diskon    = total_diskon;
                        }

                        var total_akhir = total_pesanan - total_diskon;
                        var total_diskon_1= total_diskon.toLocaleString('en-US', {maximumFractionDigits:8});
                        var total_akhir_1= total_akhir.toLocaleString('en-US', {maximumFractionDigits:8});
                        $("#total_diskon").text(total_diskon_1);
                        $("#total_akhir").text(total_akhir_1);
                    }else{

                        var total_pesanan    = {{ $total }};
                        var total_akhir_1    = total_pesanan.toLocaleString('en-US', {maximumFractionDigits:8});
                        $("#total_diskon").text('0');
                        $("#total_akhir").text(total_akhir_1);
                    }
                },
                error: function(data){
                    alert("Hubungi admin");
                }
            });
        });
    </script>
@endsection