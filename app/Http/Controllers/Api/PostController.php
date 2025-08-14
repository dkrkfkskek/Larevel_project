<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Services\CommonService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $commonService;

    public function __construct(CommonService $commonService)
    {
        $this->commonService = $commonService;
    }

    // 게시글 전체 조회
    public function index()
    {
        $post = Post::latest()->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $post
        ]);
    }

    // 게시글 상세 조회
    public function show(int $id)
    {
        $check = $this->commonService->post_check($id);
        if($check) {
            return $check;
        }

        $post = Post::find($id);

        return response()->json([
            'success' => true,
            'data' => $post
        ]);
    }

    // 게시글 작성
    public function store(Request $request)
    {
        $validator = $this->commonService->validator($request, 'post');
        if ($validator) {
            return $validator;
        }

        // 데이터 생성
        Post::create($request->all());

        // 성공 응답
        return response()->json([
            'success' => true,
            'msg' => '성공',
        ]);
    }

    // 게시글 수정
    public function update(Request $request, int $id)
    {
        $validator = $this->commonService->validator($request, 'post');
        if ($validator) {
            return $validator;
        }

        $check = $this->commonService->post_check($id);
        if($check) {
            return $check;
        }

        Post::find($id)->update($request->all());

        return response()->json([
            'success' => true,
            'msg' => '성공',
        ]);
    }

    // 게시글 삭제
    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json([
            'success' => true,
            'msg' => '성공',
        ]);
    }
}
