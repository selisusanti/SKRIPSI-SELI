<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Kategori;
use App\Models\Office;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use App\Constants\RoleAccess;

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

        $cartItems          = \Cart::getContent();
        $kategori           = Kategori::get();
        $office             = Office::first();

        Session::put('cartItems', $cartItems);
        Session::put('kategori', $kategori);
        Session::put('office', $office);

        return $next($request);
    }

}