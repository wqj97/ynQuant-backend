<?php

namespace App\Http\Controllers;

use App\Comments;
use App\Likes;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * 点赞
     * @param Request $request
     * @return bool|\Illuminate\Database\Eloquent\Model|null
     * @throws \Exception
     */
    public function Like (Request $request)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);
        $like = Likes::where('comment_id', $request->id)->where('user_id', $request->user()->id);
        if ($like->exists()) {
            $like->delete();
            return response()->json('success', 200);
        } else {
            Likes::create(['comment_id' => $request->id, 'user_id' => $request->user()->id]);
            return response()->json('created', 201);
        }
    }

    /**
     * 创建评论
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function Create (Request $request)
    {
        $this->validate($request, [
            'news_id' => 'required_without:knowledge_id',
            'knowledge_id' => 'required_without:news_id',
            'content' => 'required'
        ]);
        $comment = new Comments();
        $comment->content = $request->post('content');
        $comment->user_id = $request->user()->id;
        if ($request->has('news_id')) {
            $comment->news_id = $request->news_id;
        } else {
            $comment->knowledge_id = $request->knowledge_id;
        }
        $comment->save();
        return response()->json('created', 201);
    }
}
