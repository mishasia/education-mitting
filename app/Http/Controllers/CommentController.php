<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Department;
use App\Plan;

class CommentController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        $planId = request('plan_id');
        $plan = Plan::with('teacher')->where('id', $planId)->first();
        $comments = Comment::with('user')->where('plan_id', $planId)->get();
        return view("comment/index",
            compact('comments', 'plan', 'departments'));
    }

    public function save()
    {
        $userId = auth()->user()->id;
        $data = request()->all();
        $data['user_id'] = $userId;
        Comment::create($data);
        return back();
    }

    public function history($id)
    {
        $plan = Plan::where('id', $id)->first();
        $comments = Comment
            ::with('user')
            ->where('plan_id', $id)
            ->get();

        return view("comment.history",
            compact('comments', 'plan'));
    }

    public function remove($id){

        $comment=Comment::find($id)->delete();
        return back();
    }


}
