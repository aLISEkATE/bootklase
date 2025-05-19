<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
class BaseController extends Controller
{

    public function index()
    {       $user = User::all();
        return view('index', compact('index'));
    }
}
