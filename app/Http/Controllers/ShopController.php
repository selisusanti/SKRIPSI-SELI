<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Validator;
use App\User;
use App\Models\Office;
use App\Models\Carts;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Support\Facades\Session;

class ShopController extends Controller
{
    public function __construct() {
        // $this->middleware('auth:sanctum', ['except' => ['loginview','login', 'register']]);
    }
    
    public function index(Request $request)
    {
        $search         = ($request->search) ? $request->search : null;
        $page           = ($request->page) ? $request->page : 1;
        $perpage        = env('PERPAGE', 6);

        $produk         = Produk::where('status','1')
                            ->paginate($perpage, ['*'], 'page', $page);

        $paging         = $produk->jsonSerialize();
        $cartItems      = CartController::cartList('list');


        return view('shop')
            ->with('paging', $paging)
            ->with('perpage', $perpage)
            ->with('page', $page)
            ->with('produk', $produk)
            ->with('cartItems', $cartItems);
    }


    public function detail($id)
    {
        $cartItems      = CartController::cartList('list');
        $produk         = Produk::where('id',$id)
                            ->with(['detailImage'])
                            ->first();

        return view('detail')
                ->with('produk', $produk)
                ->with('cartItems', $cartItems);
    }

    public function save(Request $request)
    {
        // \Cart::clear();
        // $produk = Produk::with('detailImage')->find($request->id);
        // \Cart::add([
        //     'id'                => $request->id,
        //     'name'              => $produk->name,
        //     'price'             => $produk->harga,
        //     'quantity'          => $request->jumlah,
        //     'image'             => $produk->image,
        //     'associatedModel'   => $produk
        // ]);

        // $items      = CartController::cartList('list');
        // return back();

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
                $jumlah = $request->jumlah + $cart->quantity;
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
                $jumlah = $request->jumlah + $cart->quantity;
                $update   = $cart->update([
                    'quantity'  => $request->jumlah,
                ]);
            }

        }
        return back();
    }


}