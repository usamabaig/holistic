<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Resources\Admin\CnicResource;
use App\Cnic;
use App\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class CnicApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        // abort_if(Gate::denies('facility_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // return new FacilityResource(Facility::with(['category', 'areas'])->get());
    }

    public function postCnicDetails(Request $request){

        if ($request->hasFile('cnic_front')) {
            $imageName1 = 'fimage_' . time() . '.' . request()->cnic_front->getClientOriginalExtension();
            Storage::disk('public')->put($imageName1, request()->cnic_front);
        }

        if ($request->hasFile('cnic_back')) {
            $imageName2 = 'bimage_' . time() . '.' . request()->cnic_back->getClientOriginalExtension();
            Storage::disk('public')->put($imageName2, request()->cnic_back);
        }

        $cnic = new Cnic;
        $cnic->user_id  = $request->user_id;
        $cnic->subservice_id = $request->subservice_id;

        $cnic->cnic_front = 'images/cnic/front/' . $imageName1;
        $cnic->cnic_back = 'images/cnic/back/' . $imageName2;

        $cnic->save();

        if($cnic->save()){
            $update_user_cnic_status = User::where('id', $request->user_id)->update(['has_cnic' => '1']);
        }

        return (new CnicResource($cnic))
        ->response()
        ->setStatusCode(Response::HTTP_CREATED);

        
    }
}
