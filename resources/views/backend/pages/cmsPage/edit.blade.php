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
                    <form action="{{route('cms-pages.update', $cmsPage->id)}}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Title<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{$cmsPage->title}}" placeholder="Enter page title">
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Slug<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text" id="basic-addon34">http://127.0.0.1:8000/</span>
                                        <input name="slug" type="text" class="form-control @error('slug') is-invalid @enderror" id="basic-url3" aria-describedby="basic-addon34" value="{{$cmsPage->slug}}"/>
                                        @error('slug')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Description<span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="4" placeholder="Enter page description">{{$cmsPage->description}}</textarea>
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
                                    <input type="text" class="form-control" name="meta_title" value="{{$cmsPage->meta_title}}" placeholder="Enter meta title">
                                </div>
                            </div>
                            

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Meta Description</label>
                                    <input type="text" class="form-control" name="meta_description" value="{{$cmsPage->meta_description}}" placeholder="Enter meta description">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Meta Keyword</label>
                                    <input type="text" class="form-control" name="meta_keywords" value="{{$cmsPage->meta_keywords}}" placeholder="Enter meta keyword">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <select class="form-select" name="status">
                                        <option @if($cmsPage->status == 1) selected @endif value="1">Active</option>
                                        <option @if($cmsPage->status == 0) selected @endif value="0">Inactive</option>
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
