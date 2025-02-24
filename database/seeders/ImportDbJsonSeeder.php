<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\Site;
use App\Models\Category;
use App\Models\Video;

class ImportDbJsonSeeder extends Seeder
{
    public function run()
    {
        $path = database_path('db.json');

        if (!File::exists($path)) {
            $this->command->error("Arquivo db.json não encontrado na pasta database.");
            return;
        }

        $json = File::get($path);
        $data = json_decode($json, true);

        // Importa sites
        if (isset($data['sites'])) {
            foreach ($data['sites'] as $siteData) {
                Site::updateOrCreate(
                    ['id' => $siteData['id']],
                    [
                        'title'  => $siteData['title'],
                        'domain' => $siteData['domain']
                    ]
                );
            }
        }

        // Importa categorias
        if (isset($data['categories'])) {
            foreach ($data['categories'] as $catData) {
                Category::updateOrCreate(
                    ['id' => $catData['id']],
                    [
                        'title'   => $catData['title'],
                        'site_id' => $catData['site_id']
                    ]
                );
            }
        }

        // Importa vídeos
        if (isset($data['videos'])) {
            foreach ($data['videos'] as $videoData) {
                Video::updateOrCreate(
                    ['id' => $videoData['id']],
                    [
                        'title'       => $videoData['title'],
                        'created_at'  => $videoData['created_at'],
                        'category'    => $videoData['category'],
                        'hls_path'    => $videoData['hls_path'],
                        'description' => $videoData['description'],
                        'thumbnail'   => $videoData['thumbnail'],
                        'site_id'     => $videoData['site_id'],
                        'views'       => $videoData['views'],
                        'likes'       => $videoData['likes'],
                        'updated_at'  => now(),
                    ]
                );
            }
        }
    }
}
