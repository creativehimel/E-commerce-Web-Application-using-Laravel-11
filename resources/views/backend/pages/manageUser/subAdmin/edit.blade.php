@extends('backend.layouts.app')
@section('title', 'Edit Sub Admin')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{route('admin.dashboard')}}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{route('sub-admins.index')}}">Manage Sub Admin</a>
                    </li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Edit Sub Admin</h4>
                    <a href="{{route('sub-admins.index')}}" class="btn btn-danger">Back</a>
                </div>
                <div class="card-body">
                    <form action="{{route('sub-admins.update', $subAdmin->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{$subAdmin->name}}" required>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{$subAdmin->email}}" required>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{$subAdmin->phone}}" required>
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" name="status">
                                    <option @if($subAdmin->status == 1) selected @endif value="1">Active</option>
                                    <option @if($subAdmin->status == 0) selected @endif value="0">Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3 d-flex">
                                <div class="me-2">
                                    @if($subAdmin->image)
                                        <img src="{{asset('assets/img/avatars/'.$subAdmin->image)}}" alt="" width="100px" height="100px" class="rounded mb-2">
                                    @endif
                                </div>
                                <div>
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" class="form-control" id="image" name="image">
                                    <input type="hidden" name="old_image" value="{{$subAdmin->image}}">
                                </div>
                                
                                
                            </div>
                            
                            <div class="col-md-12 mt-1">
                                <button type="submit" class="btn btn-primary w-100">Add Sub Admin</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection