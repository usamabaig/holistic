<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Resources\Admin\CommentResource;
use App\Comment;
use App\Facility;
use App\ServiceSubService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CommentApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        // abort_if(Gate::denies('facility_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // return new FacilityResource(Facility::with(['category', 'areas'])->get());
    }

    public function doComment(Request $request)
    {
        // if(Auth::check()){
            // $user = Auth::user()->id;
            $comment = new Comment; 
            $comment->user_id = $request->user_id;
            $comment->subservice_id = $request->package_id;
            $comment->comment = $request->comment;
            // dd($comment->toArray());
            $comment->save();

            return (new CommentResource($comment))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);    
    }



    public function commentHistory(Request $request)
    {
        $subServices = Facility::where('category_id', $request->service_id)->get();
        if ($subServices) {
            $ServiceSubservices = ServiceSubService::where('facility_id', $subServices[0]['id'])->get();
            foreach ($ServiceSubservices as $key => $subservice) {
                $ids[$key] = $subservice['sub_service_id'];
            }
        }
        // $sub_service_ids = explode(',',$ids);
        $comments = Comment::select('u.id', 'u.full_name', 'comments.comment', 'comments.created_at')->join('users as u', 'u.id', '=', 'comments.user_id')
        ->whereIn('subservice_id', $ids)->get();
        return new CommentResource($comments);
    }

}
