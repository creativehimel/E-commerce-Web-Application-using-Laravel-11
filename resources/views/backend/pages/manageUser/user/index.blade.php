@extends('backend.layouts.app')
@section('title', 'Manage Customers')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{route('admin.dashboard')}}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Manage Customers</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Customer List</h4>
                </div>
                <div class="card-body">
                    <div class="card-datatable table-responsive pt-0">
                    <table class="table" id="customers">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                        @foreach($users as $key => $user)
                            <tr>
                                <td>{{++$key}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->phone}}</td>
                                <td>
                                    @if($user->status == 1)
                                        <span onclick="#" class="badge bg-label-success me-1 cursor-pointer">Active</span>
                                    @else
                                        <span onclick="#" class="badge bg-label-danger me-1 cursor-pointer">Inactive</span>
                                    @endif
                                </td>
                                <td>{{$user->created_at->toFormattedDateString()}}</td>
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
            $('#customers').DataTable();
        })

        
    function statusUpdate(id) {
        $.ajax({
            type: "POST",
            url: "{{ route('cms-pages.change-status') }}",
            data: {
                id: id,
                _token: "{{ csrf_token() }}"
            },
            success: function (response) {
                window.location.reload();
            }
        });
    }
    </script>
@endsection