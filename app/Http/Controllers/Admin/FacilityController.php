<?php

namespace App\Http\Controllers\Admin;

use App\Area;
use App\Facility;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyFacilityRequest;
use App\Http\Requests\StoreFacilityRequest;
use App\Http\Requests\UpdateFacilityRequest;
use App\ServiceCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FacilityController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('facility_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $facilities = Facility::all();

        return view('admin.facilities.index', compact('facilities'));
    }

    public function create()
    {
        abort_if(Gate::denies('facility_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = ServiceCategory::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $areas = Area::all()->pluck('name', 'id');

        return view('admin.facilities.create', compact('categories', 'areas'));
    }

    public function store(StoreFacilityRequest $request)
    {
        // dd($request->toArray());
        $facility = Facility::create($request->all());
        $facility->areas()->sync($request->input('areas', []));

        if ($request->input('banner_image', false)) {
            $facility->addMedia(storage_path('tmp/uploads/' . $request->input('banner_image')))->toMediaCollection('banner_image');
        }
        
        foreach ($request->input('picture', []) as $file) {
            $facility->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('picture');
        }

        return redirect()->route('admin.facilities.index');
    }

    public function edit(Facility $facility)
    {
        abort_if(Gate::denies('facility_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = ServiceCategory::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $areas = Area::all()->pluck('name', 'id');

        $facility->load('category', 'areas');

        return view('admin.facilities.edit', compact('categories', 'areas', 'facility'));
    }

    public function update(UpdateFacilityRequest $request, Facility $facility)
    {
        $facility->update($request->all());
        $facility->areas()->sync($request->input('areas', []));

        if ($request->input('banner_image', false)) {
            if (!$facility->banner_image || $request->input('banner_image') !== $facility->banner_image->file_name) {
                $facility->addMedia(storage_path('tmp/uploads/' . $request->input('banner_image')))->toMediaCollection('banner_image');
            }
        } elseif ($facility->banner_image) {
            $facility->banner_image->delete();
        }

        if (count($facility->picture) > 0) {
            foreach ($facility->picture as $media) {
                if (!in_array($media->file_name, $request->input('picture', []))) {
                    $media->delete();
                }
            }
        }

        $media = $facility->picture->pluck('file_name')->toArray();

        foreach ($request->input('picture', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $facility->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('picture');
            }
        }

        return redirect()->route('admin.facilities.index');
    }

    public function show(Facility $facility)
    {
        abort_if(Gate::denies('facility_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $facility->load('category', 'areas');

        return view('admin.facilities.show', compact('facility'));
    }

    public function destroy(Facility $facility)
    {
        abort_if(Gate::denies('facility_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $facility->delete();

        return back();
    }

    public function massDestroy(MassDestroyFacilityRequest $request)
    {
        Facility::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
