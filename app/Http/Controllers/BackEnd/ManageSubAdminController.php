<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class ManageSubAdminController extends Controller
{
    public function index()
    {
        Session::put('page', 'manageSubAdmin');
        $subAdmins = User::where('role', '2')->get();

        return view('backend.pages.manageUser.subAdmin.index', compact('subAdmins'));
    }

    public function create()
    {
        return view('backend.pages.manageUser.subAdmin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|min:11',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ]);

        $data = [
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 2,
        ];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $image_name = 'admin_'.time().'.'.$ext;
            $manager = new ImageManager(new Driver());
            $imageFile = $manager->read($image);
            $imageFile->resize(100, 100)->save(public_path('assets/img/avatars/'.$image_name));
            $data['image'] = $image_name;
        }

        User::create($data);
        toastr()->success('Sub Admin Added Successfully');

        return redirect()->route('sub-admins.index');
    }

    public function edit(User $subAdmin)
    {
        return view('backend.pages.manageUser.subAdmin.edit', compact('subAdmin'));
    }

    public function update(Request $request, User $subAdmin)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|min:11',
            'email' => 'required|unique:users,email,'.$subAdmin->id,
        ]);

        $data = [
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'status' => $request->status,
        ];

        if ($request->hasFile('image')) {
            if ($request->old_image) {
                File::delete(public_path('assets/img/avatars/'.$request->old_image));
            }
            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $image_name = 'admin_'.time().'.'.$ext;
            //$image->storeAs('public/assets/img/avatars', $image_name);
            $manager = new ImageManager(new Driver());
            $imageFile = $manager->read($image);
            $imageFile->resize(100, 100)->save(public_path('assets/img/avatars/'.$image_name));
            $data['image'] = $image_name;
        }

        $subAdmin->update($data);
        toastr()->success('Sub Admin Updated Successfully');

        return redirect()->route('sub-admins.index');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        toastr()->success('Sub Admin Deleted Successfully');

        return redirect()->route('sub-admins.index');
    }

    public function changeStatus(Request $request)
    {
        $cmsPage = User::find($request->id);
        $cmsPage->status = ! $cmsPage->status;
        $cmsPage->save();
        toastr()->success('Sub Admin Status Changed Successfully');
    }
}
