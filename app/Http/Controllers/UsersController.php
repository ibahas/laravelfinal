<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    //
    public function show()
    {
        $is_session = Auth::user()->id;
        return User::where('id', $is_session)->first();
    }

    public function showAllUsers()
    {
        //
        $users = User::all();
        return response()->json($users);
    }
}
