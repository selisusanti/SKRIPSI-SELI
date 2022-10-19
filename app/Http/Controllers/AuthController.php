<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Validator;
use App\User;

class AuthController extends Controller
{
    public function __construct() {
        // $this->middleware('auth:sanctum', ['except' => ['loginview','login', 'register']]);
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

        $token = $user->createToken('auth_token')->plainTextToken;

        // return response()
        //     ->json(['data' => $user,'access_token' => $token, 'token_type' => 'Bearer', ]);
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password')))
        {
            return response()
                ->json(['message' => 'Unauthorized'], 401);
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