<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use App\Services\CommonService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $commonService;

    public function __construct(CommonService $commonService)
    {
        $this->commonService = $commonService;
    }

    // 댓글 조회
    public function index(int $id)
    {
        $check = $this->commonService->post_check($id);
        if($check) {
            return $check;
        }

        $comments = Post::find($id)->comments()->latest()->get();

        return response()->json([
            'success' => true,
            'data' => $comments
        ]);
    }

    // 댓글 작성
    public function store(Request $request, int $id)
    {
        $validator = $this->commonService->validator($request, 'comment');
        if ($validator) {
            return $validator;
        }

        $check = $this->commonService->post_check($id);
        if($check) {
            return $check;
        }

        Post::find($id)->comments()->create($request->all());

        return response()->json([
            'success' => true,
            'msg' => '성공'
        ]);
    }

    // 댓글 수정
    public function update(Request $request, int $id)
    {
        $validator = $this->commonService->validator($request, 'post');
        if ($validator) {
            return $validator;
        }

        $check = $this->commonService->comment_check($id);
        if($check) {
            return $check;
        }

        Comment::find($id)->update($request->all());

        return response()->json([
            'success' => true,
            'msg' => '성공'
        ]);
    }

    // 댓글 삭제
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return response()->json([
            'success' => true,
            'msg' => '성공'
        ]);
    }
}
