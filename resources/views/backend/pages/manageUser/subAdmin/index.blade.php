@extends('backend.layouts.app')
@section('title', 'Manage Sub Admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{route('admin.dashboard')}}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Manage Sub Admin</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Sub Admin List</h4>
                    <a href="{{route('sub-admins.create')}}" class="btn btn-primary">Add Sub Admin</a>
                </div>
                <div class="card-body">
                    <div class="card-datatable table-responsive pt-0">
                    <table class="table" id="subAdmins">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                        @foreach($subAdmins as $key => $admin)
                            <tr>
                                <td>{{++$key}}</td>
                                <td>{{$admin->name}}</td>
                                <td>{{$admin->email}}</td>
                                <td>{{$admin->phone}}</td>
                                <td>
                                    @if($admin->role == 2)
                                        <span onclick="#" class="badge bg-label-primary me-1 cursor-pointer">Sub Admin</span>
                                    @else
                                        <span onclick="#" class="badge bg-label-danger me-1 cursor-pointer">Admin</span>
                                    @endif
                                </td>
                                <td>
                                    @if($admin->status == 1)
                                        <span onclick="#" class="badge bg-label-success me-1 cursor-pointer">Active</span>
                                    @else
                                        <span onclick="#" class="badge bg-label-danger me-1 cursor-pointer">Inactive</span>
                                    @endif
                                </td>
                                <td>{{$admin->created_at->toFormattedDateString()}}</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-warning">
                                        <i class="ti ti-edit"></i>
                                    </a>
                                    <form action="#" method="post" style="display: inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger delete">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </form>
                                    
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#subAdmins').DataTable();
        })
    </script>
@endsection