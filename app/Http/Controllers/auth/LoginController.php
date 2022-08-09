<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct() // By doing so we can access index() & store() if not guest, or not login
    {
        $this->middleware('guest');
    }
    
    public function index()
    {
        return view('auth.login');          
    }

    public function store(Request $request)
    {
        
        $this->validate($request, [  
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            return back()->with('status', 'Invalid Email Password');
        };
        
        return redirect()->route('dashboard');      
    }
}
