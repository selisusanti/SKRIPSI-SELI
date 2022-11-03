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
use App\Models\Carts;
use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{
    public function __construct() {
        // $this->middleware('auth:sanctum', ['except' => ['loginview','login', 'register']]);
    }
    
    public function index(Request $request)
    {
        // return Session::get('cartItems');
        // \Cart::clear();
        $cartItems      = CartController::cartList('list');
        $sofa           = Produk::where('status','1')
                            ->where('id_kategori','1')
                            ->get();
        $meja           = Produk::where('status','1')
                            ->where('id_kategori','2')
                            ->get();

        return view('welcome')
            ->with('meja', $meja)
            ->with('sofa', $sofa)
            ->with('cartItems', $cartItems);
    }

    public function registerview(Request $request)
    {
        return view('register');
    }

    public function loginview(Request $request)
    {
        return view('login');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users',
            'password'  => 'required|string|same:password_confirm|min:8',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
         ]);


        return redirect('/')
                ->with([
                    'success' => 'Register Sukses, tolong cek email!'
                ]);

    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password')))
        {
            Session::flash('error', "Unauthorized, Cek kembali email dan password anda !");
            return back()->withinput();
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        Auth::loginUsingId($user->id);
        $request->session()->regenerate();
        return redirect('/')
                ->with([
                    'success' => 'Welcome to solusi bantuan final portal!'
                ]);
    }

    // method for user logout and delete token
    public function logout(Request $request)
    {
        // auth()->user()->tokens()->delete();
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')
                ->with([
                    'success' => 'Sukses Logout !'
                ]);
    }
}