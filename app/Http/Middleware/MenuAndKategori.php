<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Kategori;
use App\Models\Office;
use App\Models\Carts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use App\Constants\RoleAccess;
use App\Http\Middleware\Auth;

class MenuAndKategori
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        // $cartItems          = \Cart::getContent();
        $kategori           = Kategori::get();
        $office             = Office::first();
        $cartItems          = [];

        
        if(\Auth::check()){
            $cartItems   = Carts::with(['detailProduk'])
                            ->where('status',true)
                            ->Where('user_id', \Auth::user()->id)->get();
        }else{
            $cartItems   = Carts::with(['detailProduk'])
                            ->where('status',true)
                            ->where('session_id',Session::getId())->get();
        }
        
        Session::put('cartItems', $cartItems);
        Session::put('kategori', $kategori);
        Session::put('office', $office);

        return $next($request);
    }

}