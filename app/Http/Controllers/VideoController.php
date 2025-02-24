<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * GET /api/videos
     * Retorna a lista de vídeos com filtro por título e paginação.
     * Exemplo: /api/videos?title_contains=marketing&_per_page=10
     */
    public function index(Request $request)
    {
        $query = Video::with('category'); // carrega a categoria associada

        if ($request->has('title_contains')) {
            $query->where('title', 'like', '%' . $request->input('title_contains') . '%');
        }

        $perPage = $request->input('_per_page', 100);
        $videos = $query->paginate($perPage);

        return response()->json($videos);
    }

    /**
     * GET /api/videos/{id}
     * Retorna os detalhes de um vídeo específico e incrementa o contador de views.
     */
    public function show($id)
    {
        $video = Video::with('category')->findOrFail($id);
        $video->increment('views');
        return response()->json($video);
    }

    /**
     * PATCH /api/videos/{id}
     * Permite atualizar dados do vídeo e, por exemplo, incrementar os likes.
     * Exemplo de payload para incrementar likes:
     * {
     *   "like": true
     * }
     */
    public function update(Request $request, $id)
    {
        if ($request->header('X-CSRF-TOKEN') !== csrf_token()) {
            return response()->json(['error' => 'CSRF token mismatch'], 419);
        }

        // Correção: use "->" para encadear os métodos
        $video = Video::with('category')->findOrFail($id);

        $data = $request->only(['title', 'description']);
        if (!empty($data)) {
            $video->update($data);
        }

        if ($request->has('like') && $request->input('like') == true) {
            $video->increment('likes');
        }
        if ($request->has('like') && $request->input('like') == false) {
            $video->decrement('likes');
        }

        return response()->json($video);
    }

}
