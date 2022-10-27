<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Validator;
use App\User;
use App\Models\Office;
use App\Models\Pertanyaan;

class ContactController extends Controller
{
    public function __construct() {
        // $this->middleware('auth:sanctum', ['except' => ['loginview','login', 'register']]);
    }
    
    public function index(Request $request)
    {
        $office     = Office::first();
        return view('contact')
            ->with('office', $office);
    }


    public function comment(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255',
            'pesan'     => 'required|string',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $pertanyaan = Pertanyaan::create([
            'name'       => $request->name,
            'email'      => $request->email,
            'deskripsi'  => $request->pesan
         ]);


        return back()
                ->with([
                    'success' => 'Sukses mengirim pertanyaan.'
                ]);

    }

}