@extends('backend.layouts.app')
@section('title', 'CMS Pages')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{route('admin.dashboard')}}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">CMS Pages</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">CMS Pages</h4>
                    <a href="{{route('cms-pages.create')}}" class="btn btn-primary">Add CMS Page</a>
                </div>
                <div class="card-body">
                    <table class="table table-responsive text-nowrap" id="cmsPages">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                        @foreach($cmsPages as $key => $page)
                            <tr>
                                <td>{{++$key}}</td>
                                <td>{{$page->title}}</td>
                                <td>{{$page->slug}}</td>
                                <td>
                                    @if($page->status == 1)
                                        <span onclick="statusUpdate({{$page->id}})" class="badge bg-label-success me-1 cursor-pointer">Active</span>
                                    @else
                                        <span onclick="statusUpdate({{$page->id}})" class="badge bg-label-danger me-1 cursor-pointer">Inactive</span>
                                    @endif
                                </td>
                                <td>{{$page->created_at->toFormattedDateString()}}</td>
                                <td>
                                    <a href="{{route('cms-pages.editPage', $page->slug)}}" class="btn btn-sm btn-warning">
                                        <i class="ti ti-edit"></i>
                                    </a>
                                    <form action="{{route('cms-pages.destroy', $page->id)}}" method="post" style="display: inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
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
<script>
    $(document).ready(function () {
        $('#cmsPages').DataTable();
    })

    function statusUpdate(id) {
        $.ajax({
            type: "POST",
            url: "{{route('cms-pages.change-status')}}",
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
