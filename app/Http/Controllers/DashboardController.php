<?php

namespace App\Http\Controllers;

use App\Models\Botol;
use App\Models\Varian;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $varians = Varian::all()->count();
        return view('dashboard.index', compact('varians'));
    }
}

