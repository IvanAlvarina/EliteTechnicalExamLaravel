<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Album;

class AlbumController extends Controller
{
    public function index()
    {
        return response()->json(Album::all(), 200);
    }

    public function store(Request $request)
    {
        $album = Album::create($request->all());
        return response()->json($album, 201);
    }

    public function show($id)
    {
        $album = Album::find($id);
        if (!$album) {
            return response()->json(['message' => 'Album not found'], 404);
        }
        return response()->json($album, 200);
    }

    public function update(Request $request, $id)
    {
        $album = Album::find($id);
        if (!$album) {
            return response()->json(['message' => 'Album not found'], 404);
        }
        $album->update($request->all());
        return response()->json($album, 200);
    }

    public function destroy($id)
    {
        $album = Album::find($id);
        if (!$album) {
            return response()->json(['message' => 'Album not found'], 404);
        }
        $album->delete();
        return response()->json(['message' => 'Album deleted'], 200);
    }
}
