<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request){
      
        $validated = $request->validate([
            "first_name" => ["required", "max:255"],
            "last_name" => ["required", "max:255"],
            "role" => ["required", Rule::in(['teacher', 'student'])],
            "email" => ['required', 'email', Rule::unique('users', 'email')],
            "password" => ["required", Password::min(6)->numbers()->letters()->symbols(),"confirmed"],
            "avatar" => ["nullable", "image", "max:2048"], // Validate avatar file
          ]);

   if ($request->hasFile('avatar')) {
        $validated['avatar'] = $request->file('avatar')->store('avatars', 'public'); // Store avatar
    }


          $user = User::create($validated);
          Auth::login($user);

          return redirect("/");  
      }
           
}
