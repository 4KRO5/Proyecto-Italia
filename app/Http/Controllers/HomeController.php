<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('home', ['users' => $users]);
    }
}