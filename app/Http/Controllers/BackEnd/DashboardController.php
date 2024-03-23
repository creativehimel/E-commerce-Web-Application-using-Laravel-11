<?php

namespace App\Http\Controllers\BackEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Drivers\Gd\Driver;

class DashboardController extends Controller
{
    public function index()
    {
        Session::put('page', 'dashboard');
        return view('backend.pages.dashboard');
    }

    public function getAdminDetails()
    {
        Session::put('page', 'updateProfile');
        $admin = Auth::user()->select('id', 'name', 'phone', 'email',  'image')->first();
        return view('backend.pages.adminProfile', compact('admin'));
    }

    public function updateAdminProfile(Request $request)
    {

        $admin = Auth::user();
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'image' => 'nullable|image'
        ]);
        $data = [
            'name' => $request->name,
            'phone' => $request->phone
        ];
        if ($request->hasFile('image')) {
            if ($request->old_image){
                File::delete(public_path('assets/img/avatars/'.$request->old_image));
            }
            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $image_name = 'admin_' . $admin->id . '_' . time() . '.' . $ext;
            //$image->storeAs('public/assets/img/avatars', $image_name);
            $manager = new ImageManager(new Driver());
            $imageFile = $manager->read($image);
            $imageFile->resize(100, 100)->save(public_path('assets/img/avatars/' . $image_name));
            $data['image'] = $image_name;
        }
        $admin->update($data);
        toastr()->success('Admin Profile Updated Successfully');
        return redirect()->back();
    }
}
