<?php

namespace Tests\Feature;

use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VideoControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_lists_videos_without_filter()
    {
        Video::factory()->count(5)->create();

        $response = $this->getJson('/api/videos');

        $response->assertStatus(200)
                 ->assertJsonCount(5, 'data');
    }

    /** @test */
    public function it_lists_videos_with_title_filter()
    {
        Video::factory()->create(['title' => 'Laravel Testing']);
        Video::factory()->create(['title' => 'PHP Basics']);

        $response = $this->getJson('/api/videos?title_contains=Laravel');

        $response->assertStatus(200)
                 ->assertJsonCount(1, 'data')
                 ->assertJsonFragment(['title' => 'Laravel Testing']);
    }

    /** @test */
    public function it_shows_a_video_and_increments_views()
    {
        $video = Video::factory()->create(['views' => 10]);

        $response = $this->getJson("/api/videos/{$video->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['views' => 11]); // Confirma que incrementou
    }

    /** @test */
    public function it_updates_video_title_and_description()
    {
        $video = Video::factory()->create([
            'title' => 'Old Title',
            'description' => 'Old Description'
        ]);

        $response = $this->patchJson("/api/videos/{$video->id}", [
            'title' => 'New Title',
            'description' => 'New Description'
        ], ['X-CSRF-TOKEN' => csrf_token()]);

        $response->assertStatus(200)
                 ->assertJsonFragment([
                     'title' => 'New Title',
                     'description' => 'New Description'
                 ]);
    }

    /** @test */
    public function it_increments_likes_when_like_is_true()
    {
        $video = Video::factory()->create(['likes' => 5]);

        $response = $this->patchJson("/api/videos/{$video->id}", [
            'like' => true
        ], ['X-CSRF-TOKEN' => csrf_token()]);

        $response->assertStatus(200)
                 ->assertJsonFragment(['likes' => 6]);
    }

    /** @test */
    public function it_decrements_likes_when_like_is_false()
    {
        $video = Video::factory()->create(['likes' => 5]);

        $response = $this->patchJson("/api/videos/{$video->id}", [
            'like' => false
        ], ['X-CSRF-TOKEN' => csrf_token()]);

        $response->assertStatus(200)
                 ->assertJsonFragment(['likes' => 4]);
    }
}
