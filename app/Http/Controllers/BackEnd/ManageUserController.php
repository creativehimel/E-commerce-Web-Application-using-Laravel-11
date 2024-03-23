<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class ManageUserController extends Controller
{
    public function index()
    {
        Session::put('page', 'manageUsers');
        $users = User::where('role', '0')->get();

        return view('backend.pages.manageUser.user.index', compact('users'));
    }
}
