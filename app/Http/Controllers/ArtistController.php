<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    public function index()
    {
        $artists = Artist::paginate(10);

        return view('ArtistView', ['artists' => $artists]);
    }

    public function createOrEdit($id = null)
    {
        $artist = null;

        if ($id) {
            $artist = Artist::find($id);
            if (!$artist) {
                return redirect()->route('CreateArtist')->with('error', 'Artist not found.');
            }
        }

        return view('CreateArtist', compact('artist'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|integer',
            'name' => 'required'
        ]);

        $store = Artist::create([
            'code' => $request->input('code'),
            'name' => $request->input('name'),
        ]);

        return redirect()->route('Artist')->with('success', 'Artist added successfully!');

    }

    public function update(Request $request, $id)
    {
        $artist = Artist::find($id);
        if (!$artist) {
            return redirect()->route('Artist')->with('error', 'Artist not found.');
        }

        $request->validate([
            'code' => 'required|integer',
            'name' => 'required'
        ]);

        $artist->update([
            'code' => $request->code,
            'name' => $request->name,
        ]);

        return redirect()->route('Artist')->with('success', 'Artist updated successfully!');
    }

    public function delete($id)
    {
        $artist = Artist::find($id);

        $artist->delete();

        return redirect()->route('Artist')->with('success', 'Artist deleted successfully!');
    }
}
