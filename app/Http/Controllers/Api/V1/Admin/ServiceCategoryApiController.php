<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreServiceCategoryRequest;
use App\Http\Requests\UpdateServiceCategoryRequest;
use App\Http\Resources\Admin\ServiceCategoryResource;
use App\ServiceCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ServiceCategoryApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        // abort_if(Gate::denies('service_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ServiceCategoryResource(ServiceCategory::all());
    }

    public function store(StoreServiceCategoryRequest $request)
    {
        $serviceCategory = ServiceCategory::create($request->all());

        if ($request->input('picture', false)) {
            $serviceCategory->addMedia(storage_path('tmp/uploads/' . $request->input('picture')))->toMediaCollection('picture');
        }

        return (new ServiceCategoryResource($serviceCategory))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ServiceCategory $serviceCategory)
    {
        // abort_if(Gate::denies('service_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ServiceCategoryResource($serviceCategory);
    }

    public function update(UpdateServiceCategoryRequest $request, ServiceCategory $serviceCategory)
    {
        $serviceCategory->update($request->all());

        if ($request->input('picture', false)) {
            if (!$serviceCategory->picture || $request->input('picture') !== $serviceCategory->picture->file_name) {
                $serviceCategory->addMedia(storage_path('tmp/uploads/' . $request->input('picture')))->toMediaCollection('picture');
            }
        } elseif ($serviceCategory->picture) {
            $serviceCategory->picture->delete();
        }

        return (new ServiceCategoryResource($serviceCategory))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ServiceCategory $serviceCategory)
    {
        // abort_if(Gate::denies('service_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $serviceCategory->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
