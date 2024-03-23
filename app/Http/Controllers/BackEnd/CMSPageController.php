<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\CmsPage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CMSPageController extends Controller
{
    public function index()
    {
        Session::put('page', 'cmsPages');
        $cmsPages = CmsPage::select('id', 'title', 'slug', 'status', 'created_at')->orderBy('id', 'desc')->get();
        return view('backend.pages.cmsPage.index', compact('cmsPages'));
    }

    public function create()
    {
        return view('backend.pages.cmsPage.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        $slug = Str::slug($request->title);
        CmsPage::create([
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
        ]);
        toastr()->success('CMS Page Created Successfully');
        return redirect()->route('cms-pages.index');
    }

    public function show($id)
    {
        $cmsPage = CmsPage::find($id);
        return view('backend.pages.cmsPage.show', compact('cmsPage'));
    }

    public function edit(CmsPage $cmsPage)
    {
        // $cmsPage = CmsPage::where('slug', $slug)->first();
        return view('backend.pages.cmsPage.edit', compact('cmsPage'));
    }

    public function update(Request $request, CmsPage $cmsPage)
    {
        $request->validate([
            'title' => 'required|unique:cms_pages,title,' .$cmsPage->id,
            'slug' => 'required',
            'description' => 'required',
        ]);
        $cmsPage->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'description' => $request->description,
            'status' => $request->status,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
        ]);
        toastr()->success('CMS Page Updated Successfully');
        return redirect()->route('cms-pages.index');
    }

    public function destroy($id)
    {
        CmsPage::find($id)->delete();
        toastr()->success('CMS Page Deleted Successfully');
        return redirect()->route('cms-pages.index');
    }

    public function changeStatus(Request $request)
    {
        $cmsPage = CmsPage::find($request->id);
        $cmsPage->status = !$cmsPage->status;
        $cmsPage->save();
        toastr()->success('CMS Page Status Changed Successfully');
    }

    

    

}
