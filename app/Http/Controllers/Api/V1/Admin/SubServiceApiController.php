<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreSubServiceRequest;
use App\Http\Requests\UpdateSubServiceRequest;
use App\Http\Resources\Admin\SubServiceResource;
use App\SubService;
use App\ServiceSubService;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SubServiceApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        // abort_if(Gate::denies('sub_service_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SubServiceResource(SubService::with(['services'])->get());
    }

    public function getSubServicesByService(Request $request)
    {
        // dd($request->toArray());
        // $facility = Facility::where('id', $request->facility_id)->first();
        if($request->facility_id){
            $ServiceSubservices = ServiceSubService::where('facility_id', $request->facility_id)->get();
            // dd($ServiceSubservices);
        foreach ($ServiceSubservices as $key => $subservice) {
            $ids[$key] = $subservice['sub_service_id'];
        }

        if (isset($ids)) {
            $subServices = SubService::
                // join('facility_sub_service as fss', 'fss.sub_service_id', '=', 'sub_services.id')->
                whereIn('id', $ids)->get();
            return new SubServiceResource($subServices);
        }
        }

    }


    public function store(StoreSubServiceRequest $request)
    {
        $subService = SubService::create($request->all());
        $subService->services()->sync($request->input('services', []));

        if ($request->input('picture', false)) {
            $subService->addMedia(storage_path('tmp/uploads/' . $request->input('picture')))->toMediaCollection('picture');
        }

        return (new SubServiceResource($subService))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(SubService $subService)
    {
        // abort_if(Gate::denies('sub_service_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SubServiceResource($subService->load(['services']));
    }

    public function update(UpdateSubServiceRequest $request, SubService $subService)
    {
        $subService->update($request->all());
        $subService->services()->sync($request->input('services', []));

        if ($request->input('picture', false)) {
            if (!$subService->picture || $request->input('picture') !== $subService->picture->file_name) {
                $subService->addMedia(storage_path('tmp/uploads/' . $request->input('picture')))->toMediaCollection('picture');
            }
        } elseif ($subService->picture) {
            $subService->picture->delete();
        }

        return (new SubServiceResource($subService))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(SubService $subService)
    {
        // abort_if(Gate::denies('sub_service_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subService->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
