@extends('backend.layouts.app')
@section('title', 'Create CMS Pages')
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
                    <h4 class="mb-0">Create CMS Pages</h4>
                    <a href="{{route('cms-pages.index')}}" class="btn btn-danger">Back</a>
                </div>
                <div class="card-body">
                    <form action="{{route('cms-pages.store')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Title<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{old('title')}}" placeholder="Enter page title">
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Description<span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="4" placeholder="Enter page description">{{old('description')}}</textarea>
                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Meta Title</label>
                                    <input type="text" class="form-control" name="meta_title" value="{{old('meta_title')}}" placeholder="Enter meta title">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Meta Description</label>
                                    <input type="text" class="form-control" name="meta_description" value="{{old('meta_description')}}" placeholder="Enter meta description">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Meta Keyword</label>
                                    <input type="text" class="form-control" name="meta_keywords" value="{{old('meta_keywords')}}" placeholder="Enter meta keyword">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <select class="form-select" name="status">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @endsection
