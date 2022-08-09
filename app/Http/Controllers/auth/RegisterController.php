<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct() // By doing so we can access index() & store() if not guest, or not login
    {
        $this->middleware('guest');
    }
    
    public function index()
    {
       return view('auth.register'); 
    }

    public function store(Request $request) {
        $this->validate($request, [  
            'name' => 'required|max:255',
            'username' => 'required|max:255',
            'email' => 'required|max:255|email',
            'password' => 'required|confirmed'
        ]);
        // echo "<pre>";
        // print_r($request->toArray());

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        auth()->attempt($request->only('email', 'password'));
        
        return redirect()->route('dashboard');
    }
    
}
