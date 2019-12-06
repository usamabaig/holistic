<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreSubCatagoryRequest;
use App\Http\Requests\UpdateSubCatagoryRequest;
use App\Http\Resources\Admin\SubCatagoryResource;
use App\SubCatagory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SubCatagoryApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        // abort_if(Gate::denies('sub_catagory_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SubCatagoryResource(SubCatagory::all());
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
            $subServices = SubService::join('facility_sub_service as fss', 'fss.sub_service_id', '=', 'sub_services.id')
                ->whereIn('id', $ids)->get();
            return new SubServiceResource($subServices);
        }
        }
        
    }

    public function store(StoreSubCatagoryRequest $request)
    {
        $subCatagory = SubCatagory::create($request->all());

        if ($request->input('picture', false)) {
            $subCatagory->addMedia(storage_path('tmp/uploads/' . $request->input('picture')))->toMediaCollection('picture');
        }

        return (new SubCatagoryResource($subCatagory))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(SubCatagory $subCatagory)
    {
        // abort_if(Gate::denies('sub_catagory_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SubCatagoryResource($subCatagory);
    }

    public function update(UpdateSubCatagoryRequest $request, SubCatagory $subCatagory)
    {
        $subCatagory->update($request->all());

        if ($request->input('picture', false)) {
            if (!$subCatagory->picture || $request->input('picture') !== $subCatagory->picture->file_name) {
                $subCatagory->addMedia(storage_path('tmp/uploads/' . $request->input('picture')))->toMediaCollection('picture');
            }
        } elseif ($subCatagory->picture) {
            $subCatagory->picture->delete();
        }

        return (new SubCatagoryResource($subCatagory))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(SubCatagory $subCatagory)
    {
        // abort_if(Gate::denies('sub_catagory_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subCatagory->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
