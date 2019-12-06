<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySubCatagoryRequest;
use App\Http\Requests\StoreSubCatagoryRequest;
use App\Http\Requests\UpdateSubCatagoryRequest;
use App\SubCatagory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SubCatagoryController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('sub_catagory_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subCatagories = SubCatagory::all();

        return view('admin.subCatagories.index', compact('subCatagories'));
    }

    public function create()
    {
        abort_if(Gate::denies('sub_catagory_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.subCatagories.create');
    }

    public function store(StoreSubCatagoryRequest $request)
    {
        $subCatagory = SubCatagory::create($request->all());

        foreach ($request->input('picture', []) as $file) {
            $subCatagory->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('picture');
        }

        return redirect()->route('admin.sub-catagories.index');
    }

    public function edit(SubCatagory $subCatagory)
    {
        abort_if(Gate::denies('sub_catagory_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.subCatagories.edit', compact('subCatagory'));
    }

    public function update(UpdateSubCatagoryRequest $request, SubCatagory $subCatagory)
    {
        $subCatagory->update($request->all());

        if (count($subCatagory->picture) > 0) {
            foreach ($subCatagory->picture as $media) {
                if (!in_array($media->file_name, $request->input('picture', []))) {
                    $media->delete();
                }
            }
        }

        $media = $subCatagory->picture->pluck('file_name')->toArray();

        foreach ($request->input('picture', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $subCatagory->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('picture');
            }
        }

        return redirect()->route('admin.sub-catagories.index');
    }

    public function show(SubCatagory $subCatagory)
    {
        abort_if(Gate::denies('sub_catagory_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.subCatagories.show', compact('subCatagory'));
    }

    public function destroy(SubCatagory $subCatagory)
    {
        abort_if(Gate::denies('sub_catagory_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subCatagory->delete();

        return back();
    }

    public function massDestroy(MassDestroySubCatagoryRequest $request)
    {
        SubCatagory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
