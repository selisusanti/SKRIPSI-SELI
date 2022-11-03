<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Validator;
use App\User;
use App\Models\Carts;
use App\Models\Office;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Diskon;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function __construct() {
    }

    public static function cartList($nilai)
    {
        if($nilai == 'list'){
            $data      = \Cart::getContent();
        }
        if($nilai == 'kategori'){
            $data       = Kategori::get();
        }
        return $data;
    }

    public function index(Request $request)
    {
        if($request->code){
            $diskon     = Diskon::where('kode_diskon',$request->code)
                            ->where('kuota','>','0')
                            ->first();


            if (empty($diskon))
            {
                Session::flash('error', "Voucher diskon tidak ditemukan!");
            }

            return view('cart')
                    ->with('kode',$request->code)
                    ->with('diskon', $diskon);
        }else{
            return view('cart');
        }

    }

    public function kupon(Request $request)
    {
            $diskon     = Diskon::where('kode_diskon',$request->code)
                            ->where('kuota','>','0')
                            ->first();


            if (empty($diskon))
            {
                Session::flash('error', "Voucher diskon tidak ditemukan!");
            }

            return response()->json([
                "statusCode" => 200,
                "diskon"     => $diskon,
            ]);

    }

    public function detail($id)
    {
        $kategori       = CartController::cartList('kategori');
        $cartItems      = CartController::cartList('list');
        $produk         = Produk::where('id',$id)
                            ->with(['detailImage'])
                            ->first();

        return view('detail')
                ->with('produk', $produk)
                ->with('cartItems', $cartItems)
                ->with('kategori', $kategori);
    }

    public function update(Request $request)
    {
        // \Cart::remove($request->id);
        // $produk     = Produk::with('detailImage')
        //                 ->find($request->id);

        // \Cart::add([
        //     'id'                => $request->id,
        //     'name'              => $produk->name,
        //     'price'             => $produk->harga,
        //     'quantity'          => $request->jumlah,
        //     'attributes'        => array(
        //         'image' => $produk->image,
        //     ),
        //     'associatedModel'   => $produk
        // ]);

        // $cartItems      = CartController::cartList('list');

        if(Auth::check()){

            $cart   = Carts::where('produk_id',$request->produk_id)
                            ->Where('user_id',Auth::user()->id);
            $cart   = $cart->first();

            if(empty($cart)){
                $insert   = Carts::create([
                            'user_id'   => Auth::user()->id,
                            'session_id' => Session::getId(),
                            'produk_id' => $request->produk_id,
                            'quantity'  => $request->jumlah,
                ]);
            }else{
                $jumlah  = $request->jumlah ;
                $update   = $cart->update([
                    'quantity'  => $jumlah,
                ]);
            }

        }else{

            $cart   = Carts::where('produk_id',$request->produk_id);
            $cart   = $cart->where(function($query) use ($request) {
                        $query->where('session_id',Session::getId());
            });
            $cart   = $cart->first();

            if(empty($cart)){
                $insert   = Carts::create([
                            'session_id' => Session::getId(),
                            'produk_id' => $request->produk_id,
                            'quantity'  => $request->jumlah,
                ]);
            }else{
                $jumlah = $request->jumlah;
                $update   = $cart->update([
                    'quantity'  => $request->jumlah,
                ]);
            }

        }
        return back();
    }

    


    public function removeCart(Request $request)
    {
        \Cart::remove($request->id);
        return back();
    }

    public function checkout(Request $request)
    {
        return view('checkout');
    }
    


}