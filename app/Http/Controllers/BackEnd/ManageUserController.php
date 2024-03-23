<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ManageUserController extends Controller
{
    public function getSubAdmin()
    {
        Session::put("page", 'manageSubAdmin');
        $subAdmins = User::where('role', '2')->get();
        return view('backend.pages.manageUser.subAdmin.index', compact('subAdmins'));
    }
    public function createSubAdmin()
    {
        
        return view('backend.pages.manageUser.subAdmin.create');
    }
    public function getUser()
    {
        Session::put("page", 'manageUsers');
        $users = User::where('role', '0')->get();
        return view('backend.pages.manageUser.user.index', compact('users'));
    }
}
