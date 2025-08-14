<?php

namespace App\Services;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommonService
{
    // 유효성 검사 함수
    public function validator(Request $request, string $type)
    {
        if($type == 'post'){
            $validator = Validator::make($request->all(), [
                'title' => 'sometimes|string|max:255',
                'content' => 'sometimes|string',
                'author' => 'sometimes|string|max:255',
            ]);
        }else if($type == 'comment') {
            $validator = Validator::make($request->all(), [
                'content' => 'required|string',
                'author' => 'required|string|max:255',
            ]);
        }

        // 실패 응답
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'msg' => '유효성 오류',
                'errors' => $validator->errors()
            ], 422);
        }

        return null;
    }

    public function post_check(int $id)
    {
        $post = Post::find($id);
        if (!$post) {
            return response()->json([
                'success' => false,
                'msg' => '존재하지않는 게시글 입니다.'
            ]);
        }

        return null;
    }

    public function comment_check(int $id)
    {
        $post = Comment::find($id);
        if (!$post) {
            return response()->json([
                'success' => false,
                'msg' => '존재하지않는 댓글 입니다.'
            ]);
        }

        return null;
    }
}
