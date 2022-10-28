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

class ShopController extends Controller
{
    public function __construct() {
        // $this->middleware('auth:sanctum', ['except' => ['loginview','login', 'register']]);
    }
    
    public function index(Request $request)
    {
        $office         = Office::first();
        $kategori       = Kategori::get();

        $search         = ($request->search) ? $request->search : null;
        $page           = ($request->page) ? $request->page : 1;
        $perpage        = env('PERPAGE', 6);

        $produk         = Produk::where('status','1')
                            ->paginate($perpage, ['*'], 'page', $page);

        $paging         = $produk->jsonSerialize();

        return view('shop')
            ->with('office', $office)
            ->with('paging', $paging)
            ->with('perpage', $perpage)
            ->with('page', $page)
            ->with('produk', $produk)
            ->with('kategori', $kategori);
    }


    public function detail($id)
    {
        $office         = Office::first();
        $kategori       = Kategori::get();
        $produk         = Produk::where('id',$id)
                            ->with(['detailImage'])
                            ->first();

        return view('detail')
                ->with('office', $office)
                ->with('produk', $produk)
                ->with('kategori', $kategori);
    }

    public function save(Request $request)
    {
        $carts          = json_decode($request->cookie('dw-carts'), true); 

        if ($carts && array_key_exists($request->id, $carts)) {
            $carts[$request->id]['jumlah'] += $request->jumlah;
        } else {
            $produk = Produk::find($request->id);
            $carts[$request->id] = [
                'jumlah'        => $request->jumlah,
                'id'            => $request->id,
                'name'          => $produk->name,
                'image'         => $produk->image,
                'harga'         => $produk->harga,
                'harga_asli'    => $produk->harga_asli,
                'produk_detail' => $produk
            ];
        }
        
        //JANGAN LUPA UNTUK DI-ENCODE KEMBALI, DAN LIMITNYA 2800 MENIT ATAU 48 JAM
        $cookie = cookie('dw-carts', json_encode($carts), 2880);
        
        return back()->cookie($cookie);
    }


}