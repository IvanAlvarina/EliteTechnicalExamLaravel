<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Album;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Total albums sold per artist
        $artistsSales = Artist::withSum('albums', 'sales')
            ->orderByDesc('albums_sum_sales')
            ->simplePaginate(5);
    
        // Combined total album sales across all artists
        $combinedAlbumSales = Album::sum('sales');
    
        return view('dashboard', compact('artistsSales', 'combinedAlbumSales'));
    }
    
 
}
