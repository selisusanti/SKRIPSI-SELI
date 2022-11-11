@extends('layouts.layouts')
@section('title', 'Profile')
@section('js_before')
    <script src="{{ asset('/js/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
@endsection
@section('content')

    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <a href="/"><i class="fa fa-home"></i> Home</a>
                        <a href="/shop">Shop</a>
                        <span>Check Out</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Shopping Cart Section Begin -->
    <section class="checkout-section spad">
        <div class="container">
                <form id="order-form" class="checkout-form" action="/checkout" method="post">
                @csrf   
                <div class="row">
                    <div class="col-lg-12">
                        <div class="checkout-content">
                            <input type="text" class="text-warning" readonly value="{{ $voucher ?  $voucher : 'Tidak Ada Kode Voucher' }}">
                        </div>
                    </div>
                </div>  
                <div class="row">
                    <div class="col-lg-6">
                        <h4>Alamat Pengiriman</h4>
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="fir">Nama<span>*</span></label>
                                <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required>
                                <span class="text-danger" id="alert_nama"></span>
                            </div>
                            <div class="col-lg-12">
                                <label for="cun">Provincy<span>*</span></label>
                                <select class="js-select2 form-control" id="provincy" name="provincy" style="width: 100%;" data-placeholder="Select Provincy" required>                                    
                                    <option value="" hidden disabled selected>Select Provincy</option>
                                    @if(isset($provincy->rajaongkir->results))
                                        @foreach ($provincy->rajaongkir->results as $row)
                                            <option value="{{ $row->province_id }}">{{ $row->province }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <span class="text-danger" id="alert_provincy"></span>
                            </div>
                            <div class="col-lg-12">
                                <label for="cun">Kota<span>*</span></label>
                                <select class="js-select2 form-control" name="kota" id="kota" required>
                                    <option value="">Please Select</option>
                                </select>
                                <span class="text-danger" id="alert_kota"></span>
                            </div>
                            <div class="col-lg-12">
                                <label for="street">Alamat Lengkap<span>*</span></label>
                                <textarea class="form-control" 
                                        id="alamat" 
                                        name="alamat" 
                                        rows="4" 
                                        placeholder="Alamat" required>{{ old('alamat') }}</textarea>
                                <span class="text-danger" id="alert_alamat"></span>
                            </div>
                            <div class="col-lg-12">
                                <label for="town">Kecamatan<span>*</span></label>
                                <input type="text" name="kecamatan" value="{{ old('kecamatan') }}" id="kecamatan" required>
                                <span class="text-danger" id="alert_kecamatan"></span>
                            </div>
                            <div class="col-lg-12">
                                <label for="town">Desa<span>*</span></label>
                                <input type="text" name="desa" value="{{ old('desa') }}" id="desa" required>
                                <span class="text-danger" id="alert_desa"></span>
                            </div>
                            <div class="col-lg-6">
                                <label for="zip">Postcode / ZIP (optional)</label>
                                <input type="text" name="kode_pos" value="{{ old('kode_pos') }}" id="kode_pos" required>
                                <span class="text-danger" id="alert_kode_pos"></span>
                            </div>
                            <div class="col-lg-6">
                                <label for="phone">Phone<span>*</span></label>
                                <input type="text" name="phone" value="{{ old('phone') }}" id="phone" required>
                                <span class="text-danger" id="alert_phone"></span>
                            </div>
                            <div class="col-lg-12">
                                <button type="button" id="cek_ongkir" class="site-btn place-btn">Cek Ongkir</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="place-order">
                            <h4>Your Order</h4>
                            <div class="order-total">
                                <ul class="order-table">
                                    <li>Product <span>Total</span></li>
                                    @php
                                        $total = 0 ;
                                        $weight = 0 ;
                                        $data_cart = Session::get('cartItems');
                                    @endphp

                                    @if(isset($data_cart))
                                        @foreach ($data_cart as $item)  
                                            @php
                                                $harga = $item->detailProduk->harga * $item->quantity;
                                                $total = $total + $harga;
                                                $weight = $weight + $item->detailProduk->weight;
                                            @endphp

                                            <li class="fw-normal">{{ $item->detailProduk->name ?? '' }} x {{ $item->quantity ?? '0' }} <span>{{ $item->detailProduk->harga }} </span></li>
                                    
                                        @endforeach
                                    @endif
                                    @php
                                        $total_diskon    = 0;
                                        $persen          = $diskon->persen_diskon ?? 0;
                                        $max             = $diskon->max_diskon ?? 0;
                                        $total_pesanan    = $total;
                                        $total_diskon     = ($total_pesanan * $persen) / 100 ;

                                        if($total_diskon > $max){
                                            $total_diskon = $max;
                                        }else{
                                            $total_diskon    = $total_diskon;
                                        }

                                        $total_akhir = $total_pesanan - $total_diskon;
                                    @endphp
                                    <li class="fw-normal">Diskon <span>{{ number_format($total_diskon ?? '','0') }}</span></li>
                                    <li class="fw-normal">Onkos Kirim <span>0</span></li>
                                    <li class="total-price">Total <span>{{ number_format($total_akhir ?? '','0') }}</span></li>
                                </ul>
                                <!-- <div class="payment-check">
                                    <div class="pc-item">
                                        <label for="pc-check">
                                            Cheque Payment
                                            <input type="checkbox" id="pc-check">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="pc-item">
                                        <label for="pc-paypal">
                                            Paypal
                                            <input type="checkbox" id="pc-paypal">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div> -->
                                <div class="order-btn">
                                    <button type="submit" class="site-btn place-btn">Place Order</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- Shopping Cart Section End -->


<!-- END Page Content -->
<script type="text/javascript">

    $('#provincy').change(function(){
        var selectOption = $('#kota');
        $('#kota option:gt(0)').remove();
        $("#kota").attr('disabled', false);

        var id = $(this).val();
        $.ajax({
            type: "GET",
            url: "/ongkir/city",
            data: { 
                provincy_id: id
            },
            success: function(data){
                var extractedVehicleData = [];
                try{
                    data.data.forEach(function(value){
                        var dataPackage = {
                            "id": value.city_id,
                            "name": value.type+' '+value.city_name,
                        }
                        extractedVehicleData.push(dataPackage);
                    });
                }catch(err){
                    // alert("Tidak ada list");
                }

                if(extractedVehicleData.length === 0){
                    alert("Tidak Ada List");
                } 
                else{
                    var selectOption = $('#kota');
                    $('#kota option:gt(0)').remove();

                    extractedVehicleData.forEach(function(value){
                        selectOption.append($("<option></option>").attr("value", value.id).text(value.name));
                    });
                }
            },
            error: function(data){
                alert("Hubungi admin");
            }
        });
    });

    $('#cek_ongkir').click(function(){
        $("#alert_phone").text('');
        $("#alert_desa").text('');
        $("#alert_kode_pos").text('');
        $("#alert_kecamatan").text('');
        $("#alert_alamat").text('');
        $("#alert_kota").text('');
        $("#alert_provincy").text('');
        $("#alert_nama").text('');

        var nama        = $('#nama').val();
        var provincy    = $('#provincy').val();
        var kota        = $('#kota').val();
        var alamat      = $('#alamat').val();
        var kecamatan   = $('#kecamatan').val();
        var kode_pos    = $('#kode_pos').val();
        var desa        = $('#desa').val();
        var phone       = $('#phone').val();
        if(phone == ''){
            $("#alert_phone").text('Input Data');
        }else{
            $("#alert_phone").text('');
        }

        if(desa == ''){
            $("#alert_desa").text('Input Data');
        }else{
            $("#alert_desa").text('');
        }

        if(kode_pos == ''){
            $("#alert_kode_pos").text('Input Data');
        }else{
            $("#alert_kode_pos").text('');
        }
        
        if(kecamatan == ''){
            $("#alert_kecamatan").text('Input Data');
        }else{
            $("#alert_kecamatan").text('');
        }

        if(alamat == ''){
            $("#alert_alamat").text('Input Data');
        }else{
            $("#alert_alamat").text('');
        }

        if(kota == ''){
            $("#alert_kota").text('Input Data');
        }else{
            $("#alert_kota").text('');
        }
        
        if(provincy == '' || provincy == null){
            $("#alert_provincy").text('Input Data');
        }else{
            $("#alert_provincy").text('');
        }

        if(nama == ''){
            $("#alert_nama").text('Input Data');
        }else{
            $("#alert_nama").text('');
        }

        var nama        = $('#nama').val();
        var provincy    = $('#provincy').val();
        var kota        = $('#kota').val();
        var alamat      = $('#alamat').val();
        var kecamatan   = $('#kecamatan').val();
        var kode_pos    = $('#kode_pos').val();
        var desa        = $('#desa').val();
        var phone       = $('#phone').val();

        if(nama != '' && provincy != '' && kota != '' && alamat != '' && kecamatan != '' && kode_pos != '' && desa != '' && phone != ''){
            $.ajax({
                type: "GET",
                url: "/ongkir/cekongkirjne",
                data: { 
                    provincy_id: provincy,
                    kota_id: kota,
                    weight : {{$weight}}
                },
                success: function(data){
                    
                },
                error: function(data){
                    alert("Hubungi admin");
                }
            });
        }

    });

</script>
@endsection