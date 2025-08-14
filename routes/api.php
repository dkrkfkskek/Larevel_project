<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CommentController;


// Post API
Route::apiResource('post', PostController::class);

// Comment API
Route::get('post/comment/{post}', [CommentController::class, 'index']);
Route::post('post/comment/{post}', [CommentController::class, 'store']);
Route::patch('comment/{comment}', [CommentController::class, 'update']);
Route::delete('comment/{comment}', [CommentController::class, 'destroy']);
