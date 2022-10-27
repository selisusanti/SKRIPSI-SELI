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
        $perpage        = env('PERPAGE', 4);

        $produk         = Produk::where('status','1')
                            ->paginate($perpage, ['*'], 'page', $page);
                            // ->get();

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
        return view('detail');
    }



}