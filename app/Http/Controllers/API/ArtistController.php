<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    public function index()
    {
        return response()->json(Artist::all(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required',
            'name' => 'required',
        ]);
    
        $artist = Artist::create($validated);
    
        return response()->json([
            'message' => 'Artist created successfully',
            'data' => $artist
        ], 201);
    }

    public function show($id)
    {
        $artist = Artist::find($id);
        if (!$artist) {
            return response()->json(['message' => 'Artist not found'], 404);
        }
        return response()->json($artist, 200);
    }

    public function update(Request $request, $id)
    {
        $artist = Artist::find($id);
        if (!$artist) {
            return response()->json(['message' => 'Artist not found'], 404);
        }
        $artist->update($request->all());
        return response()->json($artist, 200);
    }

    public function destroy($id)
    {
        $artist = Artist::find($id);
        if (!$artist) {
            return response()->json(['message' => 'Artist not found'], 404);
        }
        $artist->delete();
        return response()->json(['message' => 'Artist deleted'], 200);
    }
}
