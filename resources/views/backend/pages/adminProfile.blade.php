@extends('backend.layouts.app')
@section('title', 'Admin Profile')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{route('admin.dashboard')}}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Profile</h4>
                </div>
                <form action="{{route('admin.profile.update', $admin->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            @if(auth()->user()->image)
                                <img
                                    src="{{asset('assets/img/avatars/'.Auth::user()->image)}}"
                                    alt="user-avatar"
                                    class="d-block w-px-100 h-px-100 rounded"
                                    id="uploadedAvatar" />
                            @else
                                <img
                                    src="{{asset('assets/img/avatars/user.png')}}"
                                    alt="user-avatar"
                                    class="d-block w-px-100 h-px-100 rounded"
                                    id="uploadedAvatar" />
                            @endif
                            <div class="button-wrapper">
                                <label for="upload" class="btn btn-primary me-2 mb-3" tabindex="0">
                                    <span class="d-none d-sm-block">Upload new photo</span>
                                    <i class="ti ti-upload d-block d-sm-none"></i>
                                    <input
                                        type="file"
                                        id="upload"
                                        name="image"
                                        class="account-file-input"
                                        hidden
                                        accept="image/png, image/jpeg" />
                                    <input type="hidden" name="old_image" value="{{$admin->image}}">
                                </label>
                                <button type="button" class="btn btn-label-secondary account-image-reset mb-3">
                                    <i class="ti ti-refresh-dot d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Reset</span>
                                </button>

                                <div class="text-muted">Allowed JPEG, JPG or PNG. Max size of 800K</div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">

                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$admin->name}}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" readonly class="form-control bg-lighter" name="email" value="{{$admin->email}}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{$admin->phone}}">
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Update Profile</button>

                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Change Password</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.password.update')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Old Password</label>
                            <input type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" value="{{old('old_password')}}">
                            @error('old_password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">New Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{old('password')}}">
                            @error('password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" value="{{old('password_confirmation')}}">
                            @error('password_confirmation')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Update Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
