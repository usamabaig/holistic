<?php

namespace App\Http\Controllers\Admin;

use App\Facility;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySubServiceRequest;
use App\Http\Requests\StoreSubServiceRequest;
use App\Http\Requests\UpdateSubServiceRequest;
use App\SubService;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SubServiceController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('sub_service_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subServices = SubService::all();

        return view('admin.subServices.index', compact('subServices'));
    }

    public function create()
    {
        abort_if(Gate::denies('sub_service_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $services = Facility::all()->pluck('name', 'id');

        return view('admin.subServices.create', compact('services'));
    }

    public function store(StoreSubServiceRequest $request)
    {
        $validation = $this->validate($request, [
            'name' => 'required',
            'charges' => 'required|int',
        ]);

        $subService = SubService::create($request->all());
        $subService->services()->sync($request->input('services', []));

        foreach ($request->input('picture', []) as $file) {
            $subService->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('picture');
        }

        return redirect()->route('admin.sub-services.index');
    }

    public function edit(SubService $subService)
    {
        abort_if(Gate::denies('sub_service_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $services = Facility::all()->pluck('name', 'id');

        $subService->load('services');

        return view('admin.subServices.edit', compact('services', 'subService'));
    }

    public function update(UpdateSubServiceRequest $request, SubService $subService)
    {
        $subService->update($request->all());
        $subService->services()->sync($request->input('services', []));

        if (count($subService->picture) > 0) {
            foreach ($subService->picture as $media) {
                if (!in_array($media->file_name, $request->input('picture', []))) {
                    $media->delete();
                }
            }
        }

        $media = $subService->picture->pluck('file_name')->toArray();

        foreach ($request->input('picture', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $subService->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('picture');
            }
        }

        return redirect()->route('admin.sub-services.index');
    }

    public function show(SubService $subService)
    {
        abort_if(Gate::denies('sub_service_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subService->load('services');

        return view('admin.subServices.show', compact('subService'));
    }

    public function destroy(SubService $subService)
    {
        abort_if(Gate::denies('sub_service_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subService->delete();

        return back();
    }

    public function massDestroy(MassDestroySubServiceRequest $request)
    {
        SubService::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
