<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Validator;
use App\User;
use App\Models\Office;
use App\Models\Token;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Carts;
use App\Mail\RegisterMail;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;


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

    public function forgetPasswordView(Request $request)
    {
        return view('forget-password');
    }

    public function resetPasswordView($token)
    {
        $ada        = Token::with(['user'])
                        ->where('token',$token)
                        ->first();

        if(empty($ada)){
            Session::flash('error', "Token tidak ditemukan");
            return redirect('/')->withInput();
        }

        return view('reset-password')
                ->with('data', $ada) ;
    }

    public function loginview(Request $request)
    {
        return view('login');
    }


    public function saveResetPassword(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'password'  => 'required|string|same:confirm_password|min:8',
        ]);

        $token        = Token::where('id',$request->id_token)
                        ->first();

        if(empty($token)){
            return back()->with([
                'error' => 'Token Sudah Tidak Bisa Digunakan!'
            ]);
        }

        $saveToken  = User::where('id',$request->id_user)
                        ->update([
                            'password' => Hash::make($request->password)
                        ]);

        return redirect('/login')
                ->with([
                    'success' => 'Reset Password Sukses'
                ]);

    }

    public function sendEmail(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email'     => 'required|string|email|max:255|exists:users',
        ]);

        if($validator->fails()){  
            return back()->withErrors($validator);    
        }

        $user       = User::where('email',$request->email)->first();
        $token      = Str::random(33);
        $ada        = Token::where('email',$request->email)->get();

        if(!empty($ada)){
            $ada->each->delete();
        }

        $saveToken  = Token::create([
                        'id_user'   => $user->id,
                        'email'     => $request->email, 
                        'token'     => $token
                    ]);

        $message    = new ResetPasswordMail($token);
        Mail::to($request->email)->send($message);

        return redirect('/forgetPassword')
                ->with([
                    'success' => 'Reset Password Sukses, Cek Email anda!'
                ]);

    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users',
            'password'  => 'required|string|same:password_confirm|min:8',
        ]);

        if($validator->fails()){  
            return back()->withErrors($validator);    
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
         ]);

        $message = new RegisterMail();
        Mail::to($request->email)->send($message);

        return redirect('/register')
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