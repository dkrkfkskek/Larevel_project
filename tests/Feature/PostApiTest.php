<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostApiTest extends TestCase
{
    use RefreshDatabase; // 테스트 후 DB를 초기화합니다.

    /** @test */
    public function a_post_can_be_created_with_valid_data()
    {
        $data = [
            'title' => '새로운 게시글 제목',
            'content' => '새로운 게시글 내용',
            'author' => '작성자1',
        ];

        $response = $this->postJson('/api/posts', $data);

        $response->assertStatus(201)
            ->assertJsonFragment(['title' => '새로운 게시글 제목']);

        $this->assertDatabaseHas('posts', $data);
    }
}
