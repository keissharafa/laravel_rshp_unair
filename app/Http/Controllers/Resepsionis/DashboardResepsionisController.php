<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\Pemilik;

class DashboardResepsionisController extends Controller
{
    public function index()
    {
        $pets = Pet::all();
        $pemiliks = Pemilik::all();
        
        return view('resepsionis.dashboard-resepsionis', compact('pets', 'pemiliks'));
    }
}