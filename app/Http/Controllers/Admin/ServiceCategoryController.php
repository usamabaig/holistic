<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyServiceCategoryRequest;
use App\Http\Requests\StoreServiceCategoryRequest;
use App\Http\Requests\UpdateServiceCategoryRequest;
use App\ServiceCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ServiceCategoryController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('service_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $serviceCategories = ServiceCategory::all();

        return view('admin.serviceCategories.index', compact('serviceCategories'));
    }

    public function create()
    {
        abort_if(Gate::denies('service_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.serviceCategories.create');
    }

    public function store(StoreServiceCategoryRequest $request)
    {
        $serviceCategory = ServiceCategory::create($request->all());

        if ($request->input('banner_image', false)) {
            $serviceCategory->addMedia(storage_path('tmp/uploads/' . $request->input('banner_image')))->toMediaCollection('banner_image');
        }

        if ($request->input('picture', false)) {
            $serviceCategory->addMedia(storage_path('tmp/uploads/' . $request->input('picture')))->toMediaCollection('picture');
        }

        if ($request->input('category_picture', false)) {
            $serviceCategory->addMedia(storage_path('tmp/uploads/' . $request->input('category_picture')))->toMediaCollection('category_picture');
        }

        if ($request->input('how_it_work_picture', false)) {
            $serviceCategory->addMedia(storage_path('tmp/uploads/' . $request->input('how_it_work_picture')))->toMediaCollection('how_it_work_picture');
        }

        return redirect()->route('admin.service-categories.index');
    }

    public function edit(ServiceCategory $serviceCategory)
    {
        abort_if(Gate::denies('service_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.serviceCategories.edit', compact('serviceCategory'));
    }

    public function update(UpdateServiceCategoryRequest $request, ServiceCategory $serviceCategory)
    {
        $serviceCategory->update($request->all());

        if ($request->input('banner_image', false)) {
            if (!$serviceCategory->banner_image || $request->input('banner_image') !== $serviceCategory->banner_image->file_name) {
                $serviceCategory->addMedia(storage_path('tmp/uploads/' . $request->input('banner_image')))->toMediaCollection('banner_image');
            }
        } elseif ($serviceCategory->banner_image) {
            $serviceCategory->banner_image->delete();
        }

        if ($request->input('picture', false)) {
            if (!$serviceCategory->picture || $request->input('picture') !== $serviceCategory->picture->file_name) {
                $serviceCategory->addMedia(storage_path('tmp/uploads/' . $request->input('picture')))->toMediaCollection('picture');
            }
        } elseif ($serviceCategory->picture) {
            $serviceCategory->picture->delete();
        }

        if ($request->input('category_picture', false)) {
            if (!$serviceCategory->category_picture || $request->input('category_picture') !== $serviceCategory->category_picture->file_name) {
                $serviceCategory->addMedia(storage_path('tmp/uploads/' . $request->input('category_picture')))->toMediaCollection('category_picture');
            }
        } elseif ($serviceCategory->category_picture) {
            $serviceCategory->category_picture->delete();
        }

        if ($request->input('how_it_work_picture', false)) { 
            if (!$serviceCategory->how_it_work_picture || $request->input('how_it_work_picture') !== $serviceCategory->how_it_work_picture->file_name) {
                $serviceCategory->addMedia(storage_path('tmp/uploads/' . $request->input('how_it_work_picture')))->toMediaCollection('how_it_work_picture');
            }
        } elseif ($serviceCategory->how_it_work_picture) {
            $serviceCategory->how_it_work_picture->delete();
        }


        return redirect()->route('admin.service-categories.index');
    }

    public function revertMethod(Request $request)
    {


        $serviceCategory = ServiceCategory::findOrFail($request->id);

        if ($serviceCategory->status == 1) {
            $serviceCategory->status = 0;
            $status = 'disabled';
        } else {
            $serviceCategory->status = 1;
            $status = 'enabled';
        }

        $serviceCategory->save();

        return redirect()->route('admin.service-categories.index');
    }

    public function show(ServiceCategory $serviceCategory)
    {
        abort_if(Gate::denies('service_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.serviceCategories.show', compact('serviceCategory'));
    }

    public function destroy(ServiceCategory $serviceCategory)
    {
        abort_if(Gate::denies('service_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $serviceCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroyServiceCategoryRequest $request)
    {
        ServiceCategory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
