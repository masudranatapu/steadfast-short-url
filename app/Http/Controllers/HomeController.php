<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = User::query()
            ->with(['shortUrls'])
            ->findOrFail(Auth::user()->id);
        return view('home', compact('user'));
    }
}
