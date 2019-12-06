<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Facility;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreFacilityRequest;
use App\Http\Requests\UpdateFacilityRequest;
use App\Http\Resources\Admin\FacilityResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FacilityApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        // abort_if(Gate::denies('facility_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FacilityResource(Facility::with(['category', 'areas'])->get());
    }
    
    public function descServices()
    {
        return new FacilityResource(Facility::orderBy('id', 'desc')->get());
    }

    public function ascServices()
    {
        return new FacilityResource(Facility::orderBy('id', 'asc')->get());
    }

    public function getServicesByCategory(Request $request)
    {
        if($request->category_id){
            return new FacilityResource(Facility::where('category_id', $request->category_id)->get());
        }
    }

    public function store(StoreFacilityRequest $request)
    {
        $facility = Facility::create($request->all());
        $facility->areas()->sync($request->input('areas', []));

        if ($request->input('picture', false)) {
            $facility->addMedia(storage_path('tmp/uploads/' . $request->input('picture')))->toMediaCollection('picture');
        }

        return (new FacilityResource($facility))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Facility $facility)
    {
        // abort_if(Gate::denies('facility_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FacilityResource($facility->load(['category', 'areas']));
    }

    public function update(UpdateFacilityRequest $request, Facility $facility)
    {
        $facility->update($request->all());
        $facility->areas()->sync($request->input('areas', []));

        if ($request->input('picture', false)) {
            if (!$facility->picture || $request->input('picture') !== $facility->picture->file_name) {
                $facility->addMedia(storage_path('tmp/uploads/' . $request->input('picture')))->toMediaCollection('picture');
            }
        } elseif ($facility->picture) {
            $facility->picture->delete();
        }

        return (new FacilityResource($facility))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Facility $facility)
    {
        // abort_if(Gate::denies('facility_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $facility->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
