<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Comment;


class FeedbackController extends Controller
{
    public function index()
    {
        // abort_if(Gate::denies('feedback_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $comments = Comment::select('comments.id','u.full_name', 'ss.name', 'comments.comment', 'comments.created_at')->join('users as u', 'u.id', '=', 'comments.user_id')
        ->join('sub_services as ss', 'ss.id', '=','comments.subservice_id')->get();

        return view('admin.feedback.index', compact('comments'));
    }
}
