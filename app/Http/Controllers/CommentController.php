<?php

namespace App\Http\Controllers;

use App\Likes;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * 点赞
     * @param Request $request
     * @return Likes|bool|\Illuminate\Database\Eloquent\Model|null
     * @throws \Exception
     */
    public function Like (Request $request)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);
        $like = Likes::where('user_id', $request->user()->id);
        if ($like->exists()) {
            $like->delete();
            return response()->json('success', 200);
        } else {
            Likes::create(['comment_id' => $request->id, 'user_id' => $request->user()->id]);
            return response()->json('success', 201);
        }
    }
}
