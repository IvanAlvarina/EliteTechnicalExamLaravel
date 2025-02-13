<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Artist;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::with('artist')->paginate(10);

        return view('AlbumView', ['albums' => $albums]);
    }

    public function createOrEdit($id = null)
    {
        $album = null;
        $artists = Artist::all();

        if ($id) {
            $album = Album::find($id);
            if (!$album) {
                return redirect()->route('CreateAlbum')->with('error', 'Album not found.');
            }
        }

        return view('CreateAlbum', compact('album', 'artists'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'artist_id' => 'required',
            'name'  => 'required',
            'year'  => 'required',
            'sales' => 'required', 
            'cover_image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048'
        ]);

        $imagePath = null;

        if ($request->hasFile('cover_image')) {

            $imagePath = $request->file('cover_image')->store('album_covers', 'public');
        }

        $store = Album::create([
            'artist_id' => $request->artist_id,
            'name'  => $request->name,
            'year'  => $request->year,
            'sales' => $request->sales,
            'album_cover_path' => $imagePath
        ]);

        return redirect()->route('Album')->with('success', 'Album added successfully!');
    }

    public function update(Request $request, $id)
    {
        $album = Album::find($id);

        if (!$album) {

            return redirect()->route('Album')->with('error', 'Album not found.');
        }

        $request->validate([
            'artist_id' => 'required',
            'name'  => 'required',
            'year'  => 'required',
            'sales' => 'required', 
            'cover_image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048'
        ]);

        if ($request->hasFile('cover_image')) {
            // Delete old image if it exists
            if ($album->album_cover_path) {
                \Storage::disk('public')->delete($album->album_cover_path);
            }
    
            // Upload new image
            $imagePath = $request->file('cover_image')->store('album_covers', 'public');
    
            // Update image path in database
            $album->album_cover_path = $imagePath;
        }

        $album->update([
            'artist_id' => $request->artist_id,
            'name'  => $request->name,
            'year'  => $request->year,
            'sales' => $request->sales
        ]);

        return redirect()->route('Album')->with('success', 'Album updated successfully!');
    }

    public function delete($id)
    {
        $album = Album::find($id);
    
        if (!$album) {
            return redirect()->route('Album')->with('error', 'Album not found.');
        }
    
        if ($album->album_cover_path) {
            \Storage::disk('public')->delete($album->album_cover_path);
        }
   
        $album->delete();
    
        return redirect()->route('Album')->with('success', 'Album deleted successfully!');
    }
    
}
