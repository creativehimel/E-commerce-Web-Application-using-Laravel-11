@extends('backend.layouts.app')
@section('title', 'Manage Users')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{route('admin.dashboard')}}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Manage Users</li>
                </ol>
            </nav>
        </div>
    </div>
@endsection