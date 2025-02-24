<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use App\Models\Site;
use App\Models\Category;
use App\Models\Video;

class ImportDbJsonSeederTest extends TestCase
{
    use RefreshDatabase;

    protected string $jsonPath;

    protected function setUp(): void
    {
        parent::setUp();

        $this->jsonPath = database_path('db.json');

        File::put($this->jsonPath, json_encode([
            'sites' => [
                ['id' => 1, 'title' => 'Site 1', 'domain' => 'site1.com']
            ],
            'categories' => [
                ['id' => 1, 'title' => 'Category 1', 'site_id' => 1]
            ],
            'videos' => [
                [
                    'id' => 1,
                    'title' => 'Video 1',
                    'created_at' => now()->toDateTimeString(),
                    'category' => 'Category 1',
                    'hls_path' => 'path/to/video.m3u8',
                    'description' => 'Descrição do vídeo',
                    'thumbnail' => 'path/to/thumbnail.jpg',
                    'site_id' => 1,
                    'views' => 100,
                    'likes' => 10
                ]
            ]
        ]));
    }

    /** @test */
    public function it_imports_sites_from_json()
    {
        Artisan::call('db:seed', ['--class' => 'Database\\Seeders\\ImportDbJsonSeeder']);

        $this->assertDatabaseHas('sites', [
            'id' => 1,
            'title' => 'Site 1',
            'domain' => 'site1.com'
        ]);
    }

    /** @test */
    public function it_imports_categories_from_json()
    {
        Artisan::call('db:seed', ['--class' => 'Database\\Seeders\\ImportDbJsonSeeder']);

        $this->assertDatabaseHas('categories', [
            'id' => 1,
            'title' => 'Category 1',
            'site_id' => 1
        ]);
    }

    /** @test */
    public function it_imports_videos_from_json()
    {
        Artisan::call('db:seed', ['--class' => 'Database\\Seeders\\ImportDbJsonSeeder']);

        $this->assertDatabaseHas('videos', [
            'id' => 1,
            'title' => 'Video 1',
            'site_id' => 1,
            'views' => 100,
            'likes' => 10
        ]);
    }

    /** @test */
    public function it_shows_error_if_json_file_is_missing()
    {
        File::delete($this->jsonPath);

        $output = Artisan::call('db:seed', ['--class' => 'Database\\Seeders\\ImportDbJsonSeeder']);

        $this->assertStringContainsString('Arquivo db.json não encontrado', Artisan::output());
    }
}
