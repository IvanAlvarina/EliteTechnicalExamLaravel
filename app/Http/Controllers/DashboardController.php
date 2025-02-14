<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Album;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $artistsSales = Artist::withSum('albums', 'sales')
                        ->orderByDesc('albums_sum_sales')
                        ->simplePaginate(5);
    
        $combinedAlbumSales = Artist::withCount('albums')
                            ->orderByDesc('albums_count')
                            ->simplePaginate(5);
    
        $topArtist = Artist::withSum('albums', 'sales')
                    ->orderByDesc('albums_sum_sales')
                    ->first();

        $artist = null;
        $search = null;
    
        return view('dashboard', compact('artistsSales', 'combinedAlbumSales', 'topArtist', 'artist', 'search'));
    }
    

    public function searchArtist(Request $request)
    {
        $search = $request->input('search');

        if (empty($search)) {
            return redirect()->route('dashboard')->with('error', 'Please enter an artist name');
        }
 
        $artist = Artist::where('name', 'LIKE', "%{$search}%")
                       ->with('albums')
                       ->first();
    
   
        $artistsSales = Artist::withSum('albums', 'sales')
                        ->orderByDesc('albums_sum_sales')
                        ->simplePaginate(5);
    
        $combinedAlbumSales = Artist::withCount('albums')
                            ->orderByDesc('albums_count')
                            ->simplePaginate(5);
    
        $topArtist = Artist::withSum('albums', 'sales')
                    ->orderByDesc('albums_sum_sales')
                    ->first();
    
        $albums = $artist ? $artist->albums : collect();
    
        return view('dashboard', compact('artistsSales', 'combinedAlbumSales', 'topArtist', 'artist', 'search', 'albums'));
    }
}
