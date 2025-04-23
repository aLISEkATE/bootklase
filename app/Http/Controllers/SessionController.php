<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rules\Password;
class SessionController extends Controller
{
    public function destroy()
    {
        Auth::logout();
        
        return redirect("/");  
    } 

    public function create()
    {
        return view('auth.login');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            "email" => ['required', 'email', Rule::exists('users', 'email')],
            "password" => ["required", 'string']
          ]);
   
if (!Auth::attempt($validated)) {
    
throw ValidationException::withMessages([
    "email" => "Nepareiz e-pasts vai parole"
  ]);
}
    $request->session()->regenerate();
    return redirect("/"); 
    }
}
