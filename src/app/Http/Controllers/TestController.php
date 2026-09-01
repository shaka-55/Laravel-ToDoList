<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class TestController extends Controller
{
    //
    public function index()
    {
        $users = User::all();
        return view('blog.test',compact('users'));
    }
}
