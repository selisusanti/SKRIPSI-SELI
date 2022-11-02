<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Validator;
use App\User;
use App\Models\Office;
use App\Models\Produk;
use App\Models\Kategori;

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
        $cartItems      = CartController::cartList('list');

        return view('cart')
            ->with('cartItems', $cartItems);
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

    public function save(Request $request)
    {
        $produk = Produk::with('detailImage')
                    ->find($request->id);

        \Cart::add([
            'id'                => $request->id,
            'name'              => $produk->name,
            'price'             => $produk->harga,
            'quantity'          => $request->jumlah,
            'attributes'        => array(
                'image' => $produk->image,
            ),
            'associatedModel'   => $produk
        ]);


        $cartItems      = CartController::cartList('list');
        return back();
    }


    public function update(Request $request)
    {
        \Cart::remove($request->id);
        $produk     = Produk::with('detailImage')
                        ->find($request->id);

        \Cart::add([
            'id'                => $request->id,
            'name'              => $produk->name,
            'price'             => $produk->harga,
            'quantity'          => $request->jumlah,
            'attributes'        => array(
                'image' => $produk->image,
            ),
            'associatedModel'   => $produk
        ]);

        $cartItems      = CartController::cartList('list');
        return back();
    }

    


    public function removeCart(Request $request)
    {
        \Cart::remove($request->id);
        return back();
    }

    


}